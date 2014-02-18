<?php

echo "<p>GET:</p>";
var_dump($_GET);

echo "<p>POST:</p>";
var_dump($_POST);

?>

<!DOCTYPE html>
<html>
	<head>My first HTML form</head>
    <h2>User Login</h2>
	<form method="POST" action="">
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Enter Username">
    </p>
    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter Password">
    </p>
    <p>
        <button type="submit">Login</button>
    </p>
    </form>
    <h2>Compose an email</h2>
    <form method="POST" action="">
        <p>
            <label for="to">To:</label>
            <input name="to" type="text">
        </p>
        <p>
            <label for="from">From:</label>
            <input name="from" type="text">
        </p>
        <p>
            <label for="subject">Subject:</label>
            <input name="subject" type="text">
        </p>
        <p>
            <textarea name="email_body" rows="20" cols="80">Type your message here!</textarea>
        </p>
        <p>
            <button type="submit">Send</button>
            <label for="save_to_sent">
                <input type="checkbox" id="save_to_sent" name="save_to_sent" value="yes" checked>Save a copy in Sent Folder
            </label>
        </p>
    </form>
    <h2>Multiple Choice Test</h2>
    <form method="POST" action="">
        <p>What year was the Declaration of Independence signed?</p>
        <label for="q1a">
        <input type="radio" id="q1a" name="q1" value="1767">1767
        </label>
        <label for="q1b">
        <input type="radio" id="q1b" name="q1" value="1787">1787
        </label>
        <label for="q1c">
        <input type="radio" id="q1c" name="q1" value="1800">1800
        </label>
        <label for="q1d">
        <input type="radio" id="q1d" name="q1" value="1776">1776
        </label>

        <p>What year did the Allied Forces invade Normandy?</p>
        <label for="q2a">
        <input type="radio" id="q1a" name="q2" value="1939">1939
        </label>
        <label for="q2b">
        <input type="radio" id="q1b" name="q2" value="1941">1941
        </label>
        <label for="q2c">
        <input type="radio" id="q1c" name="q2" value="1944">1944
        </label>
        <label for="q2d">
        <input type="radio" id="q1d" name="q2" value="1946">1946
        </label>

        <p>What countries from the list below are in South America?</p>
        <label for="ctry1"><input type="checkbox" id="ctry1" name="q3a1" value="Libya">Libya</label>
        <label for="ctry2"><input type="checkbox" id="ctry2" name="q3a2" value="Argentina">Argentina</label>
        <label for="ctry3"><input type="checkbox" id="ctry3" name="q3a3" value="Guatemala">Guatemala</label>
        <label for="ctry4"><input type="checkbox" id="ctry4" name="q3a4" value="Venezuela">Venezuela</label>
        <label for="ctry5"><input type="checkbox" id="ctry5" name="q3a5" value="Ethiopia">Ethiopia</label>
        <label for="ctry6"><input type="checkbox" id="ctry6" name="q3a6" value="Chile">Chile</label>
        <button type="submit">Send</button>
    </form>
