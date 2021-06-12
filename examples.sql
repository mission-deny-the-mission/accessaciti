INSERT INTO `type` (`type_id`, `issue_name`, `type_colour`) VALUES ('1','Steps','#4287f5');
INSERT INTO `type` (`type_id`, `issue_name`, `type_colour`) VALUES ('2','Obstruction','#ff00bf');
INSERT INTO `type` (`type_id`, `issue_name`, `type_colour`) VALUES ('3','Surface','#5eff00');

INSERT INTO `location` (`lat_loc`, `long_loc`) VALUES ('53.82709938930981','-1.5929389824709421');
INSERT INTO `location` (`lat_loc`, `long_loc`) VALUES ('53.82536545873743','-1.5920051955072718');
INSERT INTO `location` (`lat_loc`, `long_loc`) VALUES ('53.826988012306316','-1.5905126402956196');
INSERT INTO `location` (`lat_loc`, `long_loc`) VALUES ('53.82748455814211','-1.5909479440676448');

INSERT INTO `issue` (`issue_description`,`location_id`,`type_id`,`current_rating`,`rating_count`,`rating_text`) VALUES ('The main door of the James Graham Building has a large flight of steps with no ramp alternative, maybe try the side door?','1','1','0','0','The helpfulness of this report is unknown.');
INSERT INTO `issue` (`issue_description`,`location_id`,`type_id`,`current_rating`,`rating_count`,`rating_text`) VALUES ('The entrance to Beckett Park is through a very narrow metal gate.','2','2','0','0','The helpfulness of this report is unknown.');
INSERT INTO `issue` (`issue_description`,`location_id`,`type_id`,`current_rating`,`rating_count`,`rating_text`) VALUES ('The pavement behind Preistley Hall gets extra slippery when wet.','3','3','0','0','The helpfulness of this report is unknown.');
INSERT INTO `issue` (`issue_description`,`location_id`,`type_id`,`current_rating`,`rating_count`,`rating_text`) VALUES ('Internal access between Student hub and bar is via a staircase, though external access is available at both ends.','4','1','0','0','The helpfulness of this report is unknown.');
