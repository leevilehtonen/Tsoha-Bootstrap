CREATE TABLE account (
  id        SERIAL PRIMARY KEY,
  username  VARCHAR(32) UNIQUE  NOT NULL,
  password  VARCHAR(64)         NOT NULL,
  email     VARCHAR(128) UNIQUE NOT NULL,
  firstname VARCHAR(64)         NOT NULL,
  lastaname VARCHAR(64)         NOT NULL,
  status    VARCHAR(256)
);

CREATE TABLE discussion (
  id          SERIAL PRIMARY KEY,
  title       VARCHAR(64) NOT NULL,
  description VARCHAR(64) NOT NULL
);

CREATE TABLE topic (
  id            SERIAL PRIMARY KEY,
  discussion_id INTEGER REFERENCES discussion (id) ON DELETE CASCADE,
  title         VARCHAR(128) NOT NULL,
  created       TIMESTAMP WITHOUT TIME ZONE DEFAULT (NOW() AT TIME ZONE 'UTC')
);

CREATE TABLE post (
  id         SERIAL PRIMARY KEY,
  account_id INTEGER REFERENCES account (id) ON DELETE CASCADE,
  topic_io   INTEGER REFERENCES topic (id) ON DELETE CASCADE,
  content    VARCHAR(4096) NOT NULL,
  posted     TIMESTAMP WITHOUT TIME ZONE DEFAULT (NOW() AT TIME ZONE 'UTC')
);

CREATE TABLE tag (
  id   SERIAL PRIMARY KEY,
  name VARCHAR(32)
);

CREATE TABLE topic_tag (
  id       SERIAL PRIMARY KEY,
  topic_id INTEGER REFERENCES topic (id) ON DELETE CASCADE,
  tag_id   INTEGER REFERENCES tag (id) ON DELETE CASCADE
);