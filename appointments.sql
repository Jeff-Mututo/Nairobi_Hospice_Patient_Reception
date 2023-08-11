DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `appointment_time` mediumint default NULL,
  `patient_satisfaction` mediumint default NULL,
  `month` mediumint default NULL,
  `year` mediumint default NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (55,9,3,2022),
  (30,10,11,2018),
  (46,7,2,2020),
  (31,5,4,2021),
  (22,6,2,2020),
  (53,10,8,2019),
  (36,7,2,2018),
  (38,7,8,2020),
  (31,7,5,2018),
  (57,10,7,2022);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (23,8,3,2020),
  (55,7,11,2021),
  (47,9,2,2019),
  (36,7,3,2021),
  (27,10,9,2019),
  (44,5,1,2018),
  (24,7,2,2019),
  (33,10,8,2020),
  (44,6,7,2019),
  (26,8,9,2020);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (22,7,4,2020),
  (60,8,10,2019),
  (54,8,4,2020),
  (44,7,9,2019),
  (39,5,4,2022),
  (59,10,7,2020),
  (29,7,4,2021),
  (38,7,9,2022),
  (34,7,8,2019),
  (59,6,8,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (53,8,6,2022),
  (25,7,9,2020),
  (40,8,7,2021),
  (51,9,6,2021),
  (34,6,4,2018),
  (35,7,9,2021),
  (49,6,12,2019),
  (57,7,10,2020),
  (59,8,7,2021),
  (21,8,5,2022);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (53,7,7,2019),
  (46,6,9,2019),
  (45,9,1,2020),
  (37,7,2,2018),
  (46,6,1,2019),
  (56,6,10,2018),
  (35,9,8,2022),
  (21,10,12,2018),
  (40,6,3,2022),
  (24,9,2,2018);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (41,8,7,2020),
  (21,7,3,2020),
  (26,8,3,2021),
  (26,8,9,2021),
  (55,7,1,2019),
  (39,9,10,2020),
  (55,10,11,2019),
  (30,5,10,2018),
  (20,8,8,2021),
  (30,6,7,2020);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (48,9,5,2020),
  (34,8,4,2018),
  (43,8,4,2018),
  (56,7,3,2019),
  (27,7,10,2019),
  (58,10,6,2020),
  (48,7,9,2020),
  (26,8,9,2018),
  (41,8,3,2020),
  (57,5,3,2020);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (34,7,2,2019),
  (47,9,12,2020),
  (20,8,12,2019),
  (38,6,6,2021),
  (41,8,7,2020),
  (21,6,10,2020),
  (55,9,1,2021),
  (54,9,5,2018),
  (21,6,11,2019),
  (58,6,2,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (23,6,4,2022),
  (39,10,3,2022),
  (40,7,11,2020),
  (43,6,9,2019),
  (26,9,9,2022),
  (23,9,10,2020),
  (20,8,9,2019),
  (44,7,3,2022),
  (43,7,1,2019),
  (50,7,11,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (55,7,8,2021),
  (22,6,7,2018),
  (56,5,1,2022),
  (22,8,7,2021),
  (40,6,8,2022),
  (54,7,6,2021),
  (59,6,6,2020),
  (36,9,2,2021),
  (55,7,9,2020),
  (50,9,5,2018);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (46,9,2,2019),
  (48,5,2,2018),
  (34,9,9,2021),
  (42,9,10,2020),
  (21,10,9,2018),
  (21,6,3,2020),
  (58,6,5,2022),
  (56,9,12,2021),
  (45,9,4,2021),
  (47,8,7,2018);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (59,6,4,2019),
  (33,9,8,2019),
  (24,8,6,2019),
  (48,7,8,2020),
  (29,7,4,2020),
  (44,6,8,2019),
  (57,10,8,2021),
  (49,5,10,2019),
  (35,10,8,2019),
  (22,6,5,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (51,7,8,2022),
  (54,10,3,2021),
  (32,9,10,2021),
  (32,10,5,2022),
  (31,6,4,2021),
  (42,6,10,2020),
  (44,6,10,2019),
  (37,5,10,2019),
  (46,6,8,2022),
  (45,6,1,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (44,6,11,2019),
  (32,8,9,2020),
  (51,7,5,2020),
  (57,7,1,2020),
  (50,10,8,2020),
  (39,6,2,2020),
  (29,9,2,2021),
  (36,9,4,2021),
  (33,7,5,2020),
  (25,5,3,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (24,6,12,2021),
  (52,5,4,2022),
  (58,5,5,2018),
  (32,9,2,2018),
  (56,6,7,2021),
  (22,10,4,2021),
  (41,6,2,2021),
  (51,6,11,2020),
  (37,5,11,2020),
  (58,7,9,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (59,6,12,2022),
  (48,7,11,2020),
  (38,8,8,2019),
  (39,10,11,2019),
  (55,6,7,2020),
  (49,8,1,2019),
  (32,10,4,2018),
  (44,10,2,2019),
  (45,8,1,2020),
  (31,9,3,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (57,9,9,2019),
  (52,5,9,2018),
  (54,5,7,2019),
  (53,8,2,2020),
  (21,9,11,2020),
  (28,9,11,2022),
  (39,7,3,2021),
  (33,10,8,2022),
  (32,6,8,2022),
  (26,8,11,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (41,9,4,2019),
  (36,6,7,2021),
  (46,10,3,2019),
  (42,6,7,2020),
  (44,10,4,2021),
  (43,8,5,2020),
  (26,7,1,2018),
  (52,6,9,2019),
  (58,6,4,2022),
  (27,7,4,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (49,7,10,2019),
  (37,7,9,2021),
  (35,6,11,2019),
  (37,8,8,2022),
  (28,7,5,2021),
  (23,5,9,2021),
  (46,7,4,2019),
  (22,6,2,2018),
  (57,8,3,2019),
  (59,6,2,2018);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (40,6,5,2019),
  (25,7,1,2019),
  (24,10,3,2021),
  (22,5,1,2021),
  (47,9,9,2021),
  (38,8,8,2018),
  (28,6,9,2020),
  (58,10,6,2019),
  (56,8,5,2021),
  (28,8,2,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (34,10,4,2020),
  (42,5,11,2019),
  (57,9,6,2020),
  (21,6,5,2018),
  (54,9,10,2020),
  (56,8,6,2021),
  (28,6,5,2018),
  (24,8,11,2019),
  (50,5,6,2021),
  (53,5,3,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (21,6,9,2020),
  (45,6,2,2018),
  (37,6,9,2020),
  (27,5,12,2022),
  (57,5,4,2021),
  (58,6,5,2022),
  (29,7,3,2018),
  (32,10,9,2018),
  (31,9,5,2021),
  (45,10,3,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (28,8,4,2020),
  (52,10,2,2021),
  (39,6,6,2020),
  (30,5,9,2020),
  (48,9,6,2020),
  (52,9,7,2021),
  (31,6,12,2019),
  (36,10,7,2020),
  (55,7,2,2021),
  (43,9,4,2022);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (55,9,9,2021),
  (30,7,7,2021),
  (58,7,11,2021),
  (54,9,3,2020),
  (53,10,10,2020),
  (25,6,11,2018),
  (40,9,12,2020),
  (51,7,9,2019),
  (51,5,12,2020),
  (23,10,9,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (41,8,11,2018),
  (27,6,8,2018),
  (35,5,11,2020),
  (46,7,3,2019),
  (42,8,4,2019),
  (26,9,11,2022),
  (31,7,4,2021),
  (33,7,4,2021),
  (46,8,4,2019),
  (45,8,10,2020);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (44,7,8,2021),
  (54,8,9,2021),
  (48,9,9,2021),
  (54,7,10,2021),
  (52,6,6,2020),
  (41,6,7,2021),
  (37,7,11,2021),
  (20,6,8,2021),
  (32,9,6,2022),
  (51,6,10,2021);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (51,7,7,2021),
  (59,9,6,2021),
  (43,8,4,2021),
  (39,9,8,2020),
  (31,5,2,2018),
  (54,7,3,2018),
  (36,8,7,2019),
  (32,9,5,2019),
  (21,6,10,2019),
  (49,10,3,2020);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (57,7,4,2018),
  (25,8,12,2022),
  (47,6,2,2018),
  (57,9,8,2022),
  (21,8,7,2019),
  (59,7,5,2020),
  (41,6,9,2021),
  (51,9,6,2021),
  (55,6,5,2019),
  (54,10,10,2018);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (31,10,6,2021),
  (42,7,1,2018),
  (54,9,6,2018),
  (59,8,6,2020),
  (28,8,3,2020),
  (25,10,4,2018),
  (39,6,7,2020),
  (46,9,6,2019),
  (41,8,11,2021),
  (51,8,2,2019);
INSERT INTO `appointments` (`appointment_time`,`patient_satisfaction`,`month`,`year`)
VALUES
  (58,7,2,2019),
  (59,9,10,2021),
  (33,7,9,2020),
  (27,9,3,2021),
  (26,10,4,2019),
  (23,6,6,2019),
  (25,8,8,2021),
  (58,10,10,2020),
  (48,6,7,2018),
  (45,5,1,2020);
