<?php


$mysqli = mysqli_connect("localhost","root","MzJPg2NtR644bxr","delma_www") or die("Error " . mysqli_error($link));


$conn = mysql_connect("localhost", "root", "MzJPg2NtR644bxr");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

if (!mysql_select_db("delma_www")) {
    echo "Unable to select delma_www: " . mysql_error();
    exit;
}

$sql = "SELECT distinct Trainer FROM import";

$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
    $fullname = $row['Trainer'];

    if(is_numeric($fullname)){
        break;
    }

    if($fullname==''){
        $fullname = 'Unknown';
    }

    @list($firstName,$lastName) = @explode(' ',$fullname,2);

    $emailId = trim(strtolower(str_replace(' ','_',$fullname))).'@trainer.equine.com';


    $query = "

        INSERT INTO  `delma_www`.`Users` (
        `id` ,
        `username` ,
        `username_canonical` ,
        `email` ,
        `email_canonical` ,
        `enabled` ,

        `salt` ,
        `password` ,

        `last_login` ,
        `locked` ,
        `expired` ,
        `expires_at` ,
        `confirmation_token` ,
        `password_requested_at` ,

        `roles` ,
        `credentials_expired` ,
        `credentials_expire_at` ,

        `user_firstname` ,
        `user_lastname` ,
        `user_mobile` ,
        `user_address` ,
        `user_city` ,
        `user_country` ,
        `user_type`
        )
        VALUES (
        NULL ,  '{$emailId}',  '{$emailId}',  '{$emailId}',  '{$emailId}',  '0',
          't1t8e1wp5qsooo0wggw4sow4s8ws8cw',  'IkIeeyBZe2PwVTCcBNwXcGnVn/2hmxoOmfGFXjnI1WpAWRF4LwWhHikzxkQNBIiVOkRt9vi4KNv51V9gT9Z5hg==',
          '2013-12-01 00:00:00',  '1',  '0', NULL , NULL , NULL ,
           'a:0:{}',  '0', NULL ,
            '{$firstName}' ,  '{$lastName}' , NULL , NULL ,  'DXB',  'AE', 'Trainer'
        );
  ";

    mysql_query($query);
    $insertId = mysql_insert_id();

    $updateQuery = "UPDATE import SET Trainer='{$insertId}' WHERE  Trainer = '" . $row['Trainer'] ."';";
    mysql_query($updateQuery);

    print "Inserted : $firstName \n<br />";


}

mysql_free_result($result);



$sql = "SELECT distinct PrimaryDoctor FROM import";

$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
    $fullname = $row['PrimaryDoctor'];

    if(is_numeric($fullname)){
        break;
    }

    if($fullname==''){
        $fullname = 'Unknown';
    }

    $fullname = str_replace('Dr. ','',$fullname);

    @list($firstName,$lastName) = @explode(' ',$fullname,2);

    $emailId = trim(strtolower(str_replace(' ','_',$fullname))).'@doctor.equine.com';


    $query = "

        INSERT INTO  `delma_www`.`Users` (
        `id` ,
        `username` ,
        `username_canonical` ,
        `email` ,
        `email_canonical` ,
        `enabled` ,

        `salt` ,
        `password` ,

        `last_login` ,
        `locked` ,
        `expired` ,
        `expires_at` ,
        `confirmation_token` ,
        `password_requested_at` ,

        `roles` ,
        `credentials_expired` ,
        `credentials_expire_at` ,

        `user_firstname` ,
        `user_lastname` ,
        `user_mobile` ,
        `user_address` ,
        `user_city` ,
        `user_country` ,
        `user_type`
        )
        VALUES (
        NULL ,  '{$emailId}',  '{$emailId}',  '{$emailId}',  '{$emailId}',  '0',
          't1t8e1wp5qsooo0wggw4sow4s8ws8cw',  'IkIeeyBZe2PwVTCcBNwXcGnVn/2hmxoOmfGFXjnI1WpAWRF4LwWhHikzxkQNBIiVOkRt9vi4KNv51V9gT9Z5hg==',
          '2013-12-01 00:00:00',  '1',  '0', NULL , NULL , NULL ,
           'a:0:{}',  '0', NULL ,
            '{$firstName}' ,  '{$lastName}' , NULL , NULL ,  'DXB',  'AE', 'Doctor'
        );
  ";

    mysql_query($query);
    $insertId = mysql_insert_id();

    $updateQuery = "UPDATE import SET PrimaryDoctor='{$insertId}' WHERE  PrimaryDoctor = '" . $row['PrimaryDoctor'] ."';";
    mysql_query($updateQuery);

    print "Inserted : $firstName \n<br />";


}

mysql_free_result($result);



$sql = "SELECT distinct PrimaryOwner FROM import";

$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
    $fullname = $row['PrimaryOwner'];

    if(is_numeric($fullname)){
        break;
    }

    if($fullname==''){
        $fullname = 'Unknown';
    }

    $firstName = $fullname;
    $lastName = '';

    $emailId = trim(strtolower(str_replace(' ','_',$fullname))).'@owner.equine.com';


    $query = "

        INSERT INTO  `delma_www`.`Users` (
        `id` ,
        `username` ,
        `username_canonical` ,
        `email` ,
        `email_canonical` ,
        `enabled` ,

        `salt` ,
        `password` ,

        `last_login` ,
        `locked` ,
        `expired` ,
        `expires_at` ,
        `confirmation_token` ,
        `password_requested_at` ,

        `roles` ,
        `credentials_expired` ,
        `credentials_expire_at` ,

        `user_firstname` ,
        `user_lastname` ,
        `user_mobile` ,
        `user_address` ,
        `user_city` ,
        `user_country` ,
        `user_type`
        )
        VALUES (
        NULL ,  '{$emailId}',  '{$emailId}',  '{$emailId}',  '{$emailId}',  '0',
          't1t8e1wp5qsooo0wggw4sow4s8ws8cw',  'IkIeeyBZe2PwVTCcBNwXcGnVn/2hmxoOmfGFXjnI1WpAWRF4LwWhHikzxkQNBIiVOkRt9vi4KNv51V9gT9Z5hg==',
          '2013-12-01 00:00:00',  '1',  '0', NULL , NULL , NULL ,
           'a:0:{}',  '0', NULL ,
            '{$firstName}' ,  '{$lastName}' , NULL , NULL ,  'DXB',  'AE', 'Owner'
        );
  ";

    mysql_query($query);
    $insertId = mysql_insert_id();

    $updateQuery = "UPDATE import SET PrimaryOwner='{$insertId}' WHERE  PrimaryOwner = '" . $row['PrimaryOwner'] ."';";
    mysql_query($updateQuery);

    print "Inserted : $firstName \n<br />";


}

mysql_free_result($result);



$sql = "SELECT distinct BoardedAt FROM import";

$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
    $stableName = $row['BoardedAt'];

    if(is_numeric($stableName)){
        break;
    }

    if($stableName==''){
        $stableName = 'Unknown Stable';
    }


    $query = "

INSERT INTO  `delma_www`.`Stable` (
`stable_id` ,
`stable_name` ,
`stable_group` ,
`stable_phone` ,
`stable_fax` ,
`stable_address` ,
`stable_city` ,
`stable_country`
)
VALUES (
NULL ,  '{$stableName}',  'Racing Stables', NULL , NULL , NULL ,  'DXB',  'AE'
);
";

    mysql_query($query);
    $insertId = mysql_insert_id();

    $updateQuery = "UPDATE import SET BoardedAt='{$insertId}' WHERE  BoardedAt = '" . $row['BoardedAt'] ."';";
    mysql_query($updateQuery);

    print "Inserted : $stableName \n<br />";


}

mysql_free_result($result);


$sql = "SELECT distinct Breed FROM import";

$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
    $breedName = $row['Breed'];

    if(is_numeric($breedName)){
        break;
    }

    if($breedName==''){
        $breedName = 'Unknown Breed';
    }


    $query = "

INSERT INTO  `delma_www`.`Breed` (
`breed_id` ,
`breed_name`
)
VALUES (
NULL ,  '{$breedName}'
);


";

    mysql_query($query);
    $insertId = mysql_insert_id();

    $updateQuery = "UPDATE import SET Breed='{$insertId}' WHERE  Breed = '" . $row['Breed'] ."';";
    mysql_query($updateQuery);

    print "Inserted : $stableName \n<br />";


}

mysql_free_result($result);


$sql = "SELECT *  FROM import";

$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
    extract($row);

    $time = strtotime($DOB);

    $newDOB = date('Y-m-d',$time);


    $query = "

INSERT INTO  `delma_www`.`horse` (
`horse_id` ,
`stable_id` ,
`horse_name` ,
`horse_alternate_name` ,
`horse_dob` ,
`horse_gender` ,
`horse_color` ,
`horse_type` ,
`horse_sire` ,
`horse_dam` ,
`horse_country` ,
`breed_id` ,
`owner_user_id` ,
`horse_species` ,
`trainer_user_id`,
`horse_code`,
`horse_status`

)
VALUES (
    NULL ,  '{$BoardedAt}',  '{$RegisteredName}',  '{$PetName}',  '{$newDOB}',  '{$Gender}',  '{$Color}',  '{$Profession}',  '',  '',  'AE',  '{$Breed}',  '{$PrimaryOwner}',  '{$Species}',  '{$Trainer}' , '{$Number}' , '{$Inactive}'
);


";

    mysql_query($query);
    print "Inserted : $RegisteredName \n<br />";


}

mysql_free_result($result);





