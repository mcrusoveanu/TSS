<?php

use PHPUnit\Framework\TestCase;

// Mock functions that would normally be included or are global
// In a real testing environment, you might use a mocking framework
// or refactor the original code to make these dependencies injectable.

/**
 * Mock for is_text_valid function
 * @param string $text
 * @return bool
 */
function is_text_valid($text) {
    // For testing purposes, let's assume it's valid unless specifically set up to fail
    return true;
}

/**
 * Mock for is_sir_sql_valid function
 * @param string $sql_sir
 * @return bool
 */
function is_sir_sql_valid($sql_sir) {
    // For testing purposes, let's assume it's valid unless specifically set up to fail
    return true;
}

/**
 * Mock for md5 function to control its output
 * @param string $str
 * @return string
 */
function md5($str) {
    return 'mocked_md5_' . $str; // Return a predictable mocked hash
}

// Mock database connection and query functions
class MockMySQLiResult {
    private $rows;
    private $current_row = 0;

    public function __construct(array $rows = []) {
        $this->rows = $rows;
    }

    public function num_rows() {
        return count($this->rows);
    }

    public function fetch_array() {
        if ($this->current_row < count($this->rows)) {
            return $this->rows[$this->current_row++];
        }
        return null;
    }
}

$GLOBALS['conectare'] = new stdClass(); // Mock the $conectare object

function mysqli_query($link, $query) {
    global $mock_mysqli_query_result;
    if (isset($mock_mysqli_query_result)) {
        return $mock_mysqli_query_result;
    }
    return new MockMySQLiResult([]); // Default empty result
}

function mysqli_num_rows($result) {
    return $result->num_rows();
}

function mysqli_fetch_array($result) {
    return $result->fetch_array();
}


// Define global variables and session for testing
$_SESSION = [];
$_POST = [];


class Login2Test extends TestCase
{
    protected function setUp(): void
    {
        // Reset global state before each test
        $_POST = [];
        $_SESSION = [];
        // Clear any output that might have been buffered
        ob_start();
        // Reset mock database result
        unset($GLOBALS['mock_mysqli_query_result']);
    }

    protected function tearDown(): void
    {
        ob_end_clean(); // Clean any remaining output buffer
    }

    // Helper to simulate the include of login2.php
    protected function includeLogin2()
    {
        // Suppress "headers already sent" warnings if any
        @include "login2.php"; // Adjust path if necessary
    }

    public function testMissingUsernamePostData()
    {
        $_POST = ["parola" => "testpass"];
        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Nu ati introdus date corecte", $output);
        $this->assertEmpty($_SESSION); // Session should not be set
    }

    public function testMissingPasswordPostData()
    {
        $_POST = ["username" => "testuser"];
        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Nu ati introdus date corecte", $output);
        $this->assertEmpty($_SESSION);
    }

    public function testInvalidUsernameText()
    {
        // Mock is_text_valid to return false for username
        global $mock_is_text_valid_username_result;
        $mock_is_text_valid_username_result = false;

        $_POST = [
            "username" => "invalid<script>user",
            "parola" => "testpass"
        ];
        
        // Temporarily redefine the mock function to simulate failure for username
        runkit_function_redefine('is_text_valid', '$text', '
            if ($text == "invalid<script>user" && isset($GLOBALS["mock_is_text_valid_username_result"])) {
                return false;
            }
            return true;
        ');

        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Nu ati introdus un nume de utilizator corect1!", $output);
        $this->assertEmpty($_SESSION);
    }

    // Note: The original code has `htmlspecialchars($username) == false or htmlentities($username)==false`.
    // This condition will *always* be true if the input is a valid string, as htmlspecialchars/htmlentities
    // return strings, not booleans. This part of the original code seems to be a logical error.
    // For testing, we'll assume a "correct" input still passes, which highlights the flaw.
    public function testHtmlSpecialcharsHtmlEntitiesError()
    {
        $_POST = [
            "username" => "validuser", // This will make htmlspecialchars return a string, not false
            "parola" => "testpass"
        ];

        // This test case will likely reveal the bug in the original code's HTML escaping check.
        // The current logic of `htmlspecialchars(...) == false` will always be false for valid strings,
        // so the "Nu ati introdus un nume de utilizator corect-htmlspecialchars!" message won't be triggered
        // unless htmlspecialchars/htmlentities actually return false (e.g., on encoding failure, which is rare).
        // If the original intent was to check for *changes* due to escaping, the logic needs to be different.
        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringNotContainsString("Nu ati introdus un nume de utilizator corect-htmlspecialchars!", $output);
    }


    public function testInvalidPasswordText()
    {
        // Mock is_text_valid to return false for password
        global $mock_is_text_valid_password_result;
        $mock_is_text_valid_password_result = false;

        $_POST = [
            "username" => "testuser",
            "parola" => "bad_password!"
        ];
        
        // Temporarily redefine the mock function to simulate failure for password
        runkit_function_redefine('is_text_valid', '$text', '
            if ($text == "bad_password!" && isset($GLOBALS["mock_is_text_valid_password_result"])) {
                return false;
            }
            return true;
        ');

        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Nu ati introdus o parola buna!", $output);
        $this->assertEmpty($_SESSION);
    }

    public function testDatabaseNoRowsFound()
    {
        $_POST = [
            "username" => "nonexistent_user",
            "parola" => "wrong_pass"
        ];

        // Mock mysqli_query to return an empty result set
        $GLOBALS['mock_mysqli_query_result'] = new MockMySQLiResult([]);

        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Eroare! Nu ati introdus date corecte!", $output);
        $this->assertEmpty($_SESSION);
    }

    public function testSuccessfulLogin()
    {
        $_POST = [
            "username" => "validuser",
            "parola" => "validpass"
        ];

        // Mock mysqli_query to return a valid user
        $mockUser = [
            "id_utilizator" => 1,
            "tip_utilizator" => 10,
            "username" => "validuser",
            "nume" => "Doe",
            "prenume" => "John"
        ];
        $GLOBALS['mock_mysqli_query_result'] = new MockMySQLiResult([$mockUser]);

        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Autentificare cu succes!", $output);

        // Assert session variables are set correctly
        $this->assertEquals(1, $_SESSION["id"]);
        $this->assertEquals(10, $_SESSION["tip_utilizator"]);
        // Note: original code `$_SESSION["username"]=intval($rand["username"]);` is problematic for string usernames.
        // It should probably be `$_SESSION["username"]=$rand["username"];`
        $this->assertEquals(0, $_SESSION["username"]); // intval('validuser') is 0
        $this->assertEquals("Doe", $_SESSION["nume"]);
        $this->assertEquals("John", $_SESSION["prenume"]);
    }

    public function testInvalidSQLSir()
    {
        // Mock is_sir_sql_valid to return false
        runkit_function_redefine('is_sir_sql_valid', '$sql_sir', 'return false;');

        $_POST = [
            "username" => "testuser",
            "parola" => "testpass"
        ];

        $this->includeLogin2();
        $output = ob_get_contents();
        $this->assertStringContainsString("Nu ati introdus un sir valid!", $output);
        $this->assertEmpty($_SESSION);
    }

    // You would need to mock `include("index_top.php")` and `include("index_bottom.php")` as well.
    // For simplicity in these unit tests, I've assumed they just output something or are empty.
    // In a full integration test, you might include their actual content or mock their side effects.
}

?>