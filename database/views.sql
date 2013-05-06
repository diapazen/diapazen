/*-----------------------------------------------------------------------------*/
/*----------------------------------Diapazen-----------------------------------*/
/*-----------------------------------Views-------------------------------------*/
/*-----------------------------------------------------------------------------*/

CREATE OR REPLACE VIEW diapazen.dpz_view_connexion AS
SELECT 
	dpz_users.id,
	dpz_users.firstname,
	dpz_users.lastname,
	dpz_users.email,
	dpz_users.password     
FROM diapazen.dpz_users;

CREATE OR REPLACE VIEW diapazen.dpz_view_users AS
SELECT 
	dpz_users.id,
	dpz_users.firstname,
	dpz_users.lastname,
	dpz_users.email,
	dpz_users.registration_date,
	dpz_users.last_login_date,
	dpz_users.last_login_ip 
FROM diapazen.dpz_users;

CREATE OR REPLACE VIEW diapazen.dpz_view_users_join_polls AS
SELECT 
	dpz_users.id AS USER_ID,
	dpz_users.firstname,
	dpz_users.lastname,
	dpz_users.email,
	dpz_users.registration_date,
	dpz_users.last_login_date,
	dpz_users.last_login_ip,

	dpz_polls.id AS POLL_ID,
	dpz_polls.url,
	dpz_polls.title,
	dpz_polls.description,
	dpz_polls.expiration_date,
	dpz_polls.open
FROM diapazen.dpz_users 
INNER JOIN diapazen.dpz_polls
ON dpz_users.id=dpz_polls.user_id
ORDER BY USER_ID ASC;