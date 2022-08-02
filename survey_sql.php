CREATE TABLE survey (
survey_id int(10) unsigned NOT NULL auto_increment,
survey_code varchar(20) NOT NULL default '',
survey_name varchar(128) NOT NULL default '',
survey_class tinyint(3) unsigned NOT NULL default '0',
survey_once tinyint(1) unsigned NOT NULL default '0',
survey_viewclass tinyint(3) unsigned NOT NULL default '0',
survey_editclass tinyint(3) unsigned NOT NULL default '0',
survey_mailto varchar(255) NOT NULL default '',
survey_forum int(10) unsigned NOT NULL default '0',
survey_save_results tinyint(1) unsigned NOT NULL default '0',
survey_user text NOT NULL,
survey_parms text NOT NULL,
survey_message text NOT NULL,
survey_submit_message text NOT NULL,
survey_lastfnum int(10) unsigned NOT NULL default '0',
survey_url varchar(255) NOT NULL default '',
survey_template varchar(255) NOT NULL default '',
survey_message1 tinyint(3) unsigned NOT NULL default '0',
survey_message2 tinyint(3) unsigned NOT NULL default '0',
survey_error1   tinyint(3) unsigned NOT NULL default '0',
survey_slogan text NOT NULL,
survey_neededpar tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY  (survey_id)
) ENGINE=MyISAM;

CREATE TABLE survey_results (
results_id int(10) unsigned NOT NULL auto_increment,
results_datestamp int(10) unsigned NOT NULL default '0',
results_survey_id int(10) unsigned NOT NULL default '0',
results_results text,
PRIMARY KEY  (results_id)
) ENGINE=MyISAM;

CREATE TABLE survey_messages (
message_id int(10) unsigned NOT NULL auto_increment,
message_shortcut varchar(255) NOT NULL default '',
message_text text NOT NULL,
PRIMARY KEY  (message_id)
) ENGINE=MyISAM;

