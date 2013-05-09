/*-----------------------------------------------------------------------------*/
/*----------------------------------Diapazen-----------------------------------*/
/*----------------------------------ViewsPoll----------------------------------*/
/*-----------------------------------------------------------------------------*/

CREATE OR REPLACE VIEW diapazen.dpz_view_poll AS
SELECT 
        dpz_polls.id AS POLL_ID,
        dpz_polls.url,
        dpz_polls.title,
        dpz_polls.description,
        dpz_polls.expiration_date,
        
        dpz_choices.id AS CHOICE_ID,
        dpz_choices.choice
        
FROM diapazen.dpz_polls
INNER JOIN diapazen.dpz_choices
ON dpz_polls.id=dpz_choices.poll_id
ORDER BY POLL_ID ASC;

CREATE OR REPLACE VIEW diapazen.dpz_view_choice AS
SELECT 
        dpz_choices.id AS CHOICE_ID,
        dpz_choices.poll_id AS POLL_ID,
        dpz_choices.choice,
        
        dpz_results.value
FROM diapazen.dpz_choices
INNER JOIN diapazen.dpz_results
ON dpz_choices.id=dpz_results.choice_id
ORDER BY CHOICE_ID ASC;