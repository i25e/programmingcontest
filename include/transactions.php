<?php
//create table UserInfo (Name text, User text not null, Password char(72) not null, primary key (User));
//create table PuzzleInfo (User text not null, Puzzle text not null, Answer text, SeenAt integer not null, SubmittedAt integer, primary key (User, Puzzle), foreign key (User) references UserInfo (User));

function open_database()
{
    # probably shouldn't be creating a new object every time, but whatever
    $db = new SQLite3($_SERVER['DOCUMENT_ROOT'] . 'private/test.db');
    $db->enableExceptions(true);
    return $db;
}

function add_user($name, $user, $hash)
{
    $db = open_database();

    # check to make sure the user doesn't already exist
	$stmt = $db->prepare('select count(*) as c from UserInfo where User = :user');
	$stmt->bindValue(':user', $user);

	if ($stmt->execute()->fetchArray()['c'] > 0)
	    return false;

	# add user to database
	$stmt = $db->prepare("insert into UserInfo (Name, User, Password) values (:name, :user, :password)");
	$stmt->bindValue(':name', $name);
	$stmt->bindValue(':user', $user);
	$stmt->bindValue(':password', $hash);

	return $stmt->execute();
}

# Return true if user and password match existing user, false otherwise
function authenticate_user($user, $pass)
{
    $db = open_database();
    $stmt = $db->prepare('select Password from UserInfo where User = :user');
    $stmt->bindValue(':user', $user);

    if (($input = $stmt->execute()->fetchArray()) == false)
		return false;

    return password_verify($pass, $input['Password']);
}

# Record the first time a user opens a puzzle
function record_start_time($user, $puzzle, $time)
{
    $db = open_database();
    $stmt = $db->prepare("insert or ignore into PuzzleInfo (User, Puzzle, SeenAt) values (:user, :puzzle, :time)");
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':puzzle', $puzzle);
    $stmt->bindValue(':time', $time);

    return $stmt->execute();
}

# Record the first time an answer was submitted
function record_submitted_at($user, $puzzle, $time)
{
    $db = open_database();
    $stmt = $db->prepare('update PuzzleInfo set SubmittedAt = :time where User = :user and Puzzle = :puzzle and SubmittedAt is NULL');
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':puzzle', $puzzle);
    $stmt->bindValue(':time', $time);

    return $stmt->execute();
}

function get_submitted_at($user, $puzzle)
{
    $db = open_database();
    $stmt = $db->prepare('select SubmittedAt from PuzzleInfo where User = :user and Puzzle = :puzzle');
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':puzzle', $puzzle);

    $input = $stmt->execute()->fetchArray();

    /* row doesn't exist or col isn't set */
    if (!$input || !isSet($input['SubmittedAt']))
		return false;

    return $input['SubmittedAt'];
}

# Record the expected output for some user and puzzle
function record_answer($user, $puzzle, $answer)
{
    $db = open_database();
    $stmt = $db->prepare('update PuzzleInfo set Answer = :answer where User = :user and Puzzle = :puzzle and Answer is NULL');
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':puzzle', $puzzle);
    $stmt->bindValue(':answer', $answer);

    return $stmt->execute();
}

function get_answer($user, $puzzle)
{
    $db = open_database();
    $stmt = $db->prepare('select Answer from PuzzleInfo where User = :user and Puzzle = :puzzle');
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':puzzle', $puzzle);

    $input = $stmt->execute()->fetchArray();

    /* row doesn't exist or col isn't set */
    if (!$input || !isSet($input['Answer']))
		return false;

    return $input['Answer'];
}
