<?php
$signup_sql = "INSERT INTO users(unique_id, fname, lname, email, password, image, status)  VALUES(:unique_id, :fname, :lname, :email, :password, :image, :status)";

$login_sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

$get_all_users = 'SELECT * FROM users WHERE unique_id != :unique_id';

$get_email_sql = 'SELECT * FROM users WHERE email = :email';

$get_auth_user_info = 'SELECT * FROM users WHERE unique_id = :unique_id';

$get_user_by_id = 'SELECT * FROM users WHERE unique_id = :id';

$search_sql = 'SELECT * FROM users WHERE (fname LIKE :search OR lname LIKE :search) AND unique_id != :unique_id';

$save_msg_sql = 'INSERT INTO chats(incoming_id, outgoing_id, message) VALUES(:incoming_id, :outgoing_id, :message)';

$get_msg_sql = 'SELECT * FROM chats WHERE(incoming_id = :incoming_id AND outgoing_id = :outgoing_id) OR (incoming_id = :outgoing_id AND outgoing_id = :incoming_id)';

$last_msg_sql = 'SELECT * FROM chats WHERE 
  (incoming_id = :outgoing_id AND outgoing_id = :incoming_id) 
  OR 
  (incoming_id = :incoming_id AND outgoing_id = :outgoing_id)
ORDER BY id DESC 
LIMIT 1';

$update_status_sql = 'UPDATE users
SET status = :status
WHERE unique_id = :unique_id';