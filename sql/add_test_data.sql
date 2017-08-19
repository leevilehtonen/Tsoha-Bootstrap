INSERT INTO account (username, password, email, firstname, lastname, status)
VALUES ('testuser1', '123456', 'testuser1@email.com', 'Antero', 'Korhonen', 'Ota yhteyttä rohkeasti');
INSERT INTO account (username, password, email, firstname, lastname, status)
VALUES ('testuser2', '123456', 'testuser2@email.com', 'Olavi', 'Virtanen', 'Lomalla');
INSERT INTO account (username, password, email, firstname, lastname, status)
VALUES ('testuser3', '123456', 'testuser3@email.com', 'Maria', 'Mäkinen', 'Hyvin menee');

INSERT INTO discussion (title, description)
VALUES ('Testialue', 'Sovelluksen testaamiseen tarkoitettu keskustelualue');
INSERT INTO discussion (title, description)
VALUES ('Toinen alue', 'Laajempaan testaamiseen tarkoitettu keskustelualue');

INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Testialue'), 'Eka keskustelu');
INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Testialue'), 'Toka');
INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Testialue'), 'Lisää keskustelua');
INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Toinen alue'), 'Mitä kuuluu?');
INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Toinen alue'), 'Laajempaa testiä');
INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Toinen alue'), 'Kaikkea kivaa');
INSERT INTO topic (discussion_id, title) VALUES ((SELECT id
                                                  FROM discussion d
                                                  WHERE d.title = 'Toinen alue'), 'Voi juku');

INSERT INTO post (account_id, topic_id, content) VALUES ((SELECT id
                                                          FROM account a
                                                          WHERE a.username =
                                                                'testuser1'),
                                                         (SELECT id
                                                          FROM topic t
                                                          WHERE t.title =
                                                                'Eka keskustelu'),
                                                         'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO post (account_id, topic_id, content) VALUES ((SELECT id
                                                          FROM account a
                                                          WHERE a.username =
                                                                'testuser2'),
                                                         (SELECT id
                                                          FROM topic t
                                                          WHERE t.title =
                                                                'Eka keskustelu'),
                                                         'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO post (account_id, topic_id, content) VALUES ((SELECT id
                                                          FROM account a
                                                          WHERE a.username =
                                                                'testuser3'),
                                                         (SELECT id
                                                          FROM topic t
                                                          WHERE t.title =
                                                                'Eka keskustelu'),
                                                         'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO post (account_id, topic_id, content) VALUES ((SELECT id
                                                          FROM account a
                                                          WHERE a.username =
                                                                'testuser1'),
                                                         (SELECT id
                                                          FROM topic t
                                                          WHERE t.title =
                                                                'Mitä kuuluu?'),
                                                         'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO post (account_id, topic_id, content) VALUES ((SELECT id
                                                          FROM account a
                                                          WHERE a.username =
                                                                'testuser2'),
                                                         (SELECT id
                                                          FROM topic t
                                                          WHERE t.title =
                                                                'Mitä kuuluu?'),
                                                         'Ut enim ad minim veniam. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO post (account_id, topic_id, content) VALUES ((SELECT id
                                                          FROM account a
                                                          WHERE a.username =
                                                                'testuser1'),
                                                         (SELECT id
                                                          FROM topic t
                                                          WHERE t.title =
                                                                'Mitä kuuluu?'),
                                                         'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');


INSERT INTO tag (name) VALUES ('ruoka');
INSERT INTO tag (name) VALUES ('ihmiset');
INSERT INTO tag (name) VALUES ('kotimaa');
INSERT INTO tag (name) VALUES ('herkut');
INSERT INTO tag (name) VALUES ('suolainen');
INSERT INTO tag (name) VALUES ('makea');
INSERT INTO tag (name) VALUES ('kotikokki');
INSERT INTO tag (name) VALUES ('aamupala');
INSERT INTO tag (name) VALUES ('kokeilu');

INSERT INTO topic_tag (topic_id, tag_id) VALUES ((SELECT id
                                                  FROM topic t
                                                  WHERE t.title = 'Eka keskustelu'),
                                                 (SELECT id
                                                  FROM tag ta
                                                  WHERE ta.name = 'ruoka'));

INSERT INTO topic_tag (topic_id, tag_id) VALUES ((SELECT id
                                                  FROM topic t
                                                  WHERE t.title = 'Eka keskustelu'),
                                                 (SELECT id
                                                  FROM tag ta
                                                  WHERE ta.name = 'ihmiset'));

INSERT INTO topic_tag (topic_id, tag_id) VALUES ((SELECT id
                                                  FROM topic t
                                                  WHERE t.title = 'Eka keskustelu'),
                                                 (SELECT id
                                                  FROM tag ta
                                                  WHERE ta.name = 'kotimaa'));

INSERT INTO topic_tag (topic_id, tag_id) VALUES ((SELECT id
                                                  FROM topic t
                                                  WHERE t.title = 'Mitä kuuluu?'),
                                                 (SELECT id
                                                  FROM tag ta
                                                  WHERE ta.name = 'aamupala'));

INSERT INTO topic_tag (topic_id, tag_id) VALUES ((SELECT id
                                                  FROM topic t
                                                  WHERE t.title = 'Mitä kuuluu?'),
                                                 (SELECT id
                                                  FROM tag ta
                                                  WHERE ta.name = 'kokeilu'));

INSERT INTO topic_tag (topic_id, tag_id) VALUES ((SELECT id
                                                  FROM topic t
                                                  WHERE t.title = 'Mitä kuuluu?'),
                                                 (SELECT id
                                                  FROM tag ta
                                                  WHERE ta.name = 'ihmiset'));
