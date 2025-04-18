-- Ajout du champ "role" s'il n'existe pas
ALTER TABLE users ADD COLUMN role VARCHAR(50) DEFAULT 'user';