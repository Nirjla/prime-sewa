select * from events ev join users us on us.id=ev.user_id join volunteers v on v.id = us.id;

select * from events ev join volunteers v on ev.id = v.event_id where ev.event_date > '2080/01/11' and ev.event_date < '2080/02/12';

select count(*) as total_volunteering from events ev join volunteers v on ev.id = v.event_id where ev.event_date > '2024/01/11' and v.user_id = 7;
SELECT v.user_id, COUNT(*) AS total_volunteering
FROM events ev
JOIN volunteers v ON ev.id = v.event_id
WHERE ev.event_date > '2024/01/11' AND ev.event_date < '2024/02/13'
GROUP BY v.user_id;
