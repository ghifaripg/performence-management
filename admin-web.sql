CREATE SCHEMA IF NOT EXISTS admin_web;

CREATE TABLE IF NOT EXISTS admin_web.form_kontrak_manajemen (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sasaran_id int NOT NULL,
  kpi_name varchar(500) NOT NULL,
  target varchar(500) NOT NULL,
  satuan varchar(500) NOT NULL,
  milestone varchar(500),
  esgc char,
  polaritas varchar(500),
  bobot decimal(5, 2),
  du char,
  dk char,
  do char
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.form_kontrak_manajemen (id);
CREATE INDEX admin_web_sasaran_id ON admin_web.form_kontrak_manajemen (sasaran_id);

CREATE TABLE IF NOT EXISTS admin_web.password_reset_tokens (
  email varchar(500) NOT NULL PRIMARY KEY,
  token varchar(500) NOT NULL,
  created_at timestamp
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.password_reset_tokens (email);

CREATE TABLE IF NOT EXISTS admin_web.iku_point (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  form_iku_id bigint NOT NULL,
  point_name varchar(500) NOT NULL,
  base varchar(500),
  stretch varchar(500),
  satuan varchar(500),
  polaritas varchar(500),
  bobot decimal(10, 2)
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.iku_point (id);
CREATE INDEX admin_web_form_iku_id ON admin_web.iku_point (form_iku_id);

CREATE TABLE IF NOT EXISTS admin_web.progres (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  iku_id varchar(500) NOT NULL,
  user_id bigint,
  status enum('pending') DEFAULT 'pending',
  need_discussion tinyint(1) DEFAULT 0,
  meeting_date date,
  notes text,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.progres (id);
CREATE INDEX admin_web_progres_ibfk_1 ON admin_web.progres (iku_id);
CREATE INDEX admin_web_progres_ibfk_2 ON admin_web.progres (user_id);

CREATE TABLE IF NOT EXISTS admin_web.migrations (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  migration varchar(500) NOT NULL,
  batch int NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.migrations (id);

CREATE TABLE IF NOT EXISTS admin_web.department (
  department_id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  department_name varchar(500) NOT NULL,
  department_username varchar(500) NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.department (department_id);

CREATE TABLE IF NOT EXISTS admin_web.failed_jobs (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uuid varchar(500) NOT NULL UNIQUE,
  connection text NOT NULL,
  queue text NOT NULL,
  payload longtext NOT NULL,
  exception longtext NOT NULL,
  failed_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.failed_jobs (id);
CREATE UNIQUE INDEX admin_web_failed_jobs_uuid_unique ON admin_web.failed_jobs (uuid);

CREATE TABLE IF NOT EXISTS admin_web.sessions (
  id varchar(500) NOT NULL PRIMARY KEY,
  user_id bigint,
  ip_address varchar(500),
  user_agent text,
  payload text NOT NULL,
  last_activity int NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.sessions (id);
CREATE INDEX admin_web_sessions_user_id_foreign ON admin_web.sessions (user_id);
CREATE INDEX admin_web_sessions_last_activity_index ON admin_web.sessions (last_activity);

CREATE TABLE IF NOT EXISTS admin_web.cache (
  `key` varchar(500) NOT NULL PRIMARY KEY,
  value mediumtext NOT NULL,
  expiration int NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.cache (`key`);

CREATE TABLE IF NOT EXISTS admin_web.cache_locks (
  `key` varchar(500) NOT NULL PRIMARY KEY,
  owner varchar(500) NOT NULL,
  expiration int NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.cache_locks (`key`);

CREATE TABLE IF NOT EXISTS admin_web.iku (
  iku_id varchar(500) NOT NULL PRIMARY KEY,
  department_name varchar(500) NOT NULL,
  tahun bigint NOT NULL,
  created_by varchar(500) NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.iku (iku_id);
CREATE INDEX admin_web_iku_ibfk_1 ON admin_web.iku (created_by);

CREATE TABLE IF NOT EXISTS admin_web.job_batches (
  id varchar(500) NOT NULL PRIMARY KEY,
  name varchar(500) NOT NULL,
  total_jobs int NOT NULL,
  pending_jobs int NOT NULL,
  failed_jobs int NOT NULL,
  failed_job_ids longtext NOT NULL,
  options mediumtext,
  cancelled_at int,
  created_at int NOT NULL,
  finished_at int
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.job_batches (id);

CREATE TABLE IF NOT EXISTS admin_web.isi_iku (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  iku varchar(500) NOT NULL,
  proker text NOT NULL,
  pj varchar(500) NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.isi_iku (id);

CREATE TABLE IF NOT EXISTS admin_web.sasaran_strategis (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  kontrak_id varchar(500) NOT NULL,
  name text NOT NULL,
  position int DEFAULT 0
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.sasaran_strategis (id);
CREATE INDEX admin_web_kontrak_id ON admin_web.sasaran_strategis (kontrak_id);

CREATE TABLE IF NOT EXISTS admin_web.kontrak_manajemen (
  kontrak_id varchar(500) NOT NULL PRIMARY KEY,
  year int NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.kontrak_manajemen (kontrak_id);

CREATE TABLE IF NOT EXISTS admin_web.users (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nama varchar(500) NOT NULL UNIQUE,
  password varchar(500) NOT NULL,
  created_at timestamp,
  updated_at timestamp,
  username varchar(500) NOT NULL,
  department_id bigint
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.users (id);
CREATE UNIQUE INDEX admin_web_users_name_unique ON admin_web.users (nama);
CREATE INDEX admin_web_iku_department_ibfk_1 ON admin_web.users (department_id);

CREATE TABLE IF NOT EXISTS admin_web.jobs (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  queue varchar(500) NOT NULL,
  payload longtext NOT NULL,
  attempts tinyint NOT NULL,
  reserved_at int,
  available_at int NOT NULL,
  created_at int NOT NULL
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.jobs (id);
CREATE INDEX admin_web_jobs_queue_index ON admin_web.jobs (queue);

CREATE TABLE IF NOT EXISTS admin_web.form_iku (
  id bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  iku_id varchar(500) NOT NULL,
  sasaran_id int NOT NULL,
  iku_atasan varchar(500),
  isi_iku_id bigint NOT NULL,
  target varchar(500),
  is_multi_point tinyint NOT NULL DEFAULT 0,
  base varchar(500),
  stretch varchar(500),
  satuan varchar(500),
  polaritas varchar(500),
  bobot decimal(10, 2)
);

CREATE UNIQUE INDEX admin_web_PRIMARY ON admin_web.form_iku (id);
CREATE INDEX admin_web_iku_id ON admin_web.form_iku (isi_iku_id);
CREATE INDEX admin_web_fk_iku_id ON admin_web.form_iku (iku_id);
CREATE INDEX admin_web_fk_iku_sasaran_id ON admin_web.form_iku (sasaran_id);

ALTER TABLE admin_web.form_iku ADD CONSTRAINT fk_iku_id FOREIGN KEY (iku_id) REFERENCES admin_web.iku (iku_id);
ALTER TABLE admin_web.form_iku ADD CONSTRAINT fk_iku_sasaran_id FOREIGN KEY (sasaran_id) REFERENCES admin_web.sasaran_strategis (id);
ALTER TABLE admin_web.form_iku ADD CONSTRAINT form_iku_ibfk_1 FOREIGN KEY (isi_iku_id) REFERENCES admin_web.isi_iku (id);
ALTER TABLE admin_web.form_kontrak_manajemen ADD CONSTRAINT form_kontrak_manajemen_ibfk_1 FOREIGN KEY (sasaran_id) REFERENCES admin_web.sasaran_strategis (id);
ALTER TABLE admin_web.users ADD CONSTRAINT iku_department_ibfk_1 FOREIGN KEY (department_id) REFERENCES admin_web.department (department_id);
ALTER TABLE admin_web.iku ADD CONSTRAINT iku_ibfk_1 FOREIGN KEY (created_by) REFERENCES admin_web.users (nama);
ALTER TABLE admin_web.iku_point ADD CONSTRAINT iku_point_ibfk_1 FOREIGN KEY (form_iku_id) REFERENCES admin_web.form_iku (id);
ALTER TABLE admin_web.progres ADD CONSTRAINT progres_ibfk_1 FOREIGN KEY (iku_id) REFERENCES admin_web.iku (iku_id);
ALTER TABLE admin_web.progres ADD CONSTRAINT progres_ibfk_2 FOREIGN KEY (user_id) REFERENCES admin_web.users (id);
ALTER TABLE admin_web.sasaran_strategis ADD CONSTRAINT sasaran_strategis_ibfk_1 FOREIGN KEY (kontrak_id) REFERENCES admin_web.kontrak_manajemen (kontrak_id);
ALTER TABLE admin_web.sessions ADD CONSTRAINT sessions_user_id_foreign FOREIGN KEY (user_id) REFERENCES admin_web.users (id);
