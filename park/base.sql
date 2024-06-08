create database parking;
\c parking


-- etat_monnaie 'null': non active , '10' active
create table monnaieuser(
    id serial primary key,
    id_user int references users(id),
    monnaie_entre double precision default ,
    monnaie_sortie double precision default null,
    etat_monnaie integer default null
);
select * from monnaieuser where etat_monnaie is not null ;

select * from monnaieuser where etat_monnaie is null ;

insert into monnaieuser values (default,2,null,100,null);

create or replace view reste_monnaie as
SELECT
    (sum(monnaie_entre) - (SELECT sum(monnaie_sortie) FROM monnaieuser WHERE etat_monnaie IS NULL)) AS reste ,
    id_user
    from monnaieuser where etat_monnaie is not null group by id_user ;


create table parking(
    id varchar(100) primary key ,
    nom varchar(200),
    longeur decimal(10,2) not null,
    largeur decimal(10,2) not null,
    lieu varchar(200)
);

create table tarif(
    id serial primary key ,
    heure time not null,
    prix double precision
);



CREATE OR REPLACE FUNCTION get_prix_recupere(heure_input time)
RETURNS numeric AS
$$
DECLARE
prix_recupere numeric;
BEGIN
    IF heure_input <= '00:15:00' THEN
SELECT prix INTO prix_recupere FROM tarif WHERE heure = '00:15:00' LIMIT 1;
ELSIF heure_input <= '00:30:00' THEN
SELECT prix INTO prix_recupere FROM tarif WHERE heure = '00:30:00' LIMIT 1;
ELSIF heure_input <= '00:45:00' THEN
SELECT prix INTO prix_recupere FROM tarif WHERE heure = '00:45:00' LIMIT 1;
ELSE
SELECT prix INTO prix_recupere FROM tarif WHERE heure = '01:00:00' LIMIT 1;
END IF;

RETURN prix_recupere;
END;
$$
LANGUAGE plpgsql;

select get_prix_recupere('00:15:00');

create table vehicule(
    id varchar(100) primary key,
    marque varchar(200) not null,
    longeur decimal(10,2) not null,
    largeur decimal(10,2) not null
);

create table occupation(
    id varchar(100) primary key,
    id_user int references users(id),
    idparking varchar(100) references parking(id),
    idvehicule varchar(100) references vehicule(id),
    date_debut timestamp,
    date_fin timestamp,
    etat int
);

create view get_list_p as
select p.nom, p.id, p.longeur, p.largeur, p.lieu, o.etat
from occupation as o right join parking p on p.id = o.idparking

create view get_list_parking as
SELECT p.nom, p.id, p.longeur, p.largeur, p.lieu, o.etat, o.date_debut, o.date_fin, o.id as id_station
FROM parking p
         LEFT JOIN (
    SELECT DISTINCT ON (idparking) idparking, etat, date_debut, date_fin, id
    FROM occupation
    ORDER BY idparking, date_fin DESC
) o ON p.id = o.idparking;

create or replace view get_situation as
SELECT
    lp.nom,
    lp.id,
    lp.longeur,
    lp.largeur,
    lp.lieu,
    lp.etat,
    CASE
        WHEN lp.date_debut IS NULL THEN '1111-11-11 11:11:11'
        ELSE lp.date_debut
        END AS date_debut,
    lp.date_fin,
    lp.id_station,
    CASE
        WHEN lp.date_debut IS NOT NULL AND hs.date_sortie IS NULL THEN '5000-11-11 11:11:11'
        ELSE hs.date_sortie
        END AS date_sortie
FROM
    get_list_parking AS lp
        LEFT JOIN
    historique_sortie AS hs ON lp.id_station = hs.id_station;



SELECT *
FROM get_situation
WHERE date_debut >= '2024-05-08 15:34:00' OR date_sortie > '2024-05-08 15:35:00';


SELECT DISTINCT ON (nom) nom, id, longeur, largeur, lieu, etat
FROM get_list_parking
ORDER BY nom, id, etat ASC;

CREATE VIEW vue_occuper_station AS
SELECT
    COUNT(*) * 100.0 / (SELECT COUNT(*) FROM parking) AS occuper
FROM get_list_parking
WHERE get_list_parking.etat = 10;


CREATE VIEW vue_dispo_station AS
SELECT
    COUNT(*) * 100.0 / (SELECT COUNT(*) FROM parking) AS disponible
FROM get_list_parking
WHERE get_list_parking.etat IS NULL or get_list_parking.etat = 0;


WITH mois_possibles AS (
    SELECT generate_series(1, 12) as mois
)
SELECT
    mp.mois as mois,
    COUNT(glp.date_debut) as nombre_total,
    COUNT(glp.date_debut) * 100.0 / (SELECT COUNT(*) FROM get_list_parking WHERE EXTRACT(MONTH FROM date_debut) = mp.mois) as pourcentage
FROM
    mois_possibles mp
        LEFT JOIN
    get_list_parking glp ON EXTRACT(MONTH FROM glp.date_debut) = mp.mois
GROUP BY
    mp.mois
ORDER BY
    mp.mois;


insert into occupation values ('TCK001','PARK003', '')
create table historique_occupation(
    idoccupation varchar(100) references occupation(id),
    date_sortie timestamp
);

create table amende(
    id serial primary key ,
    nom varchar(200),
    prix double precision
);

insert into amende values (default,'simple', 150000);

create table amende_vehicule(
    idoccupation varchar(100) references occupation(id),
    idamende int references amende(id),
    status int
);

create table historique_sortie(
    id serial primary key ,
    id_station varchar(100) references occupation(id),
    date_sortie timestamp not null ,
    prix_simple double precision,
    amende double precision default null
);
2024-05-08 15:30:47

insert into historique_sortie values (default, 'ST009', '2024-05-08 15:30:47', 30000, 15000);

INSERT INTO historique_sortie VALUES (DEFAULT, INTERVAL '00-0-30 15:01:00', 20000, 40000);

UPDATE historique_sortie
SET date_sortie = (EXTRACT(days FROM date_sortie) || ' days ')::INTERVAL
               + (EXTRACT(hours FROM date_sortie) || ' hours ')::INTERVAL
               + (EXTRACT(minutes FROM date_sortie) || ' minutes ')::INTERVAL
               + (EXTRACT(seconds FROM date_sortie) || ' seconds ')::INTERVAL
WHERE date_sortie >= INTERVAL '24 hours';

-- sequence parking
create sequence park_sequence start with 1 increment by 1;

create or replace function park_id() RETURNS text as $$
DECLARE
    next_id integer;
    type_text text;
BEGIN
    next_id := nextval('park_sequence');
    type_text := 'PARK' || lpad(next_id::text, 3, '0');
RETURN type_text;
END;
$$ LANGUAGE plpgsql;

-- sequence occupation
create sequence occup_sequence start with 1 increment by 1;
create or replace function occup_id() RETURNS text as $$
DECLARE
next_id integer;
    type_text text;
BEGIN
    next_id := nextval('occup_sequence');
    type_text := 'ST' || lpad(next_id::text, 3, '0');
RETURN type_text;
END;
$$ LANGUAGE plpgsql;

   create table voiture(
       id serial primary key ,
       nom varchar(100)
   );

insert into voiture values (default, 'propla');
insert into voiture values (default, 'flerys');

create table maint(
    id serial primary key,
    nom varchar(200),
    id_voiture int references voiture(id),
    valeur int default 1
);


insert into maint values (default, 'vidange',1);
insert into maint values (default, 'pneus', 1);

select id, nom as nom_voiture from voiture union select id,nom from maint;

