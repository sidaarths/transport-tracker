INSERT INTO VehicleType VALUES ('TROLLEY', 80, 75, 14);
INSERT INTO VehicleType VALUES ('BUS', 120, 85, 12);
INSERT INTO VehicleType VALUES ('SEABUS', 30, 175, 15);
INSERT INTO VehicleType VALUES ('RAIL', 130, 375, 60);
INSERT INTO VehicleType VALUES ('METRO', 80, 200, 3);
INSERT INTO VehicleType VALUES ('RAPIDBUS', 90, 120, 4);
INSERT INTO Garage VALUES('Vancouver Trolley',300, 'TROLLEY');
INSERT INTO Garage VALUES('Vancouver Bus',300, 'BUS');
INSERT INTO Garage VALUES('Vancouver Harbor', 3, 'SEABUS');
INSERT INTO Garage VALUES('Coquitlam Rail Yard', 20, 'RAIL');
INSERT INTO Garage VALUES('Burnaby Metro', 100, 'METRO');
INSERT INTO Garage VALUES('Richmond Metro', 20, 'METRO');
INSERT INTO Garage VALUES('Burnaby Long Bus',200,'RAPIDBUS');
INSERT INTO Garage VALUES('Burnaby Bus',300,'BUS');
INSERT INTO Garage VALUES('Richmond Bus', 200, 'BUS');
INSERT INTO Garage VALUES('Richmond Long Bus', 100, 'RAPIDBUS');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (1, 'BUS', TO_DATE('2015/01/10', 'YYYY/MM/DD'), 7, TO_DATE('2015/08/15', 'YYYY/MM/DD'), 'Richmond Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (2, 'BUS', TO_DATE('2015/01/10', 'YYYY/MM/DD'), 8, TO_DATE('2015/08/15', 'YYYY/MM/DD'), 'Richmond Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (3, 'BUS', TO_DATE('2015/01/10', 'YYYY/MM/DD'), 8, TO_DATE('2015/08/15', 'YYYY/MM/DD'), 'Richmond Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (4, 'RAPIDBUS', TO_DATE('2015/02/09', 'YYYY/MM/DD'), 6, TO_DATE('2015/08/05', 'YYYY/MM/DD'), 'Richmond Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (5, 'RAPIDBUS', TO_DATE('2015/02/09', 'YYYY/MM/DD'), 6, TO_DATE('2015/08/05', 'YYYY/MM/DD'), 'Richmond Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (6, 'RAPIDBUS', TO_DATE('2015/02/09', 'YYYY/MM/DD'), 6, TO_DATE('2015/08/05', 'YYYY/MM/DD'), 'Richmond Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (7, 'BUS', TO_DATE('2015/02/15', 'YYYY/MM/DD'), 8, TO_DATE('2015/10/19', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (8, 'BUS', TO_DATE('2015/02/15', 'YYYY/MM/DD'), 8, TO_DATE('2015/10/19', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (9, 'BUS', TO_DATE('2015/02/15', 'YYYY/MM/DD'), 8, TO_DATE('2015/10/19', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (10, 'BUS', TO_DATE('2015/02/15', 'YYYY/MM/DD'), 8, TO_DATE('2015/10/19', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (11, 'BUS', TO_DATE('2015/02/15', 'YYYY/MM/DD'), 8, TO_DATE('2015/10/19', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (12, 'BUS', TO_DATE('2015/02/15', 'YYYY/MM/DD'), 8, TO_DATE('2015/10/19', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (13, 'RAPIDBUS', TO_DATE('2016/01/23', 'YYYY/MM/DD'), 6, TO_DATE('2016/09/09', 'YYYY/MM/DD'), 'Burnaby Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (14, 'RAPIDBUS', TO_DATE('2016/01/23', 'YYYY/MM/DD'), 6, TO_DATE('2016/09/09', 'YYYY/MM/DD'), 'Burnaby Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (15, 'RAPIDBUS', TO_DATE('2016/01/23', 'YYYY/MM/DD'), 6, TO_DATE('2016/09/09', 'YYYY/MM/DD'), 'Burnaby Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (16, 'RAPIDBUS', TO_DATE('2016/01/23', 'YYYY/MM/DD'), 6, TO_DATE('2016/09/09', 'YYYY/MM/DD'), 'Burnaby Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (17, 'BUS', TO_DATE('2016/11/07', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (18, 'BUS', TO_DATE('2016/11/07', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (19, 'BUS', TO_DATE('2016/11/07', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (20, 'BUS', TO_DATE('2016/11/17', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (21, 'BUS', TO_DATE('2016/11/17', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Vancouver Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (22, 'BUS', TO_DATE('2016/11/17', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Burnaby Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (23, 'BUS', TO_DATE('2016/11/17', 'YYYY/MM/DD'), 8, TO_DATE('2017/04/05', 'YYYY/MM/DD'), 'Burnaby Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (24, 'RAPIDBUS', TO_DATE('2019/04/29', 'YYYY/MM/DD'), 6, TO_DATE('2019/12/21', 'YYYY/MM/DD'), 'Burnaby Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (25, 'RAPIDBUS', TO_DATE('2019/04/29', 'YYYY/MM/DD'), 6, TO_DATE('2019/12/21', 'YYYY/MM/DD'), 'Burnaby Long Bus');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (26, 'TROLLEY', TO_DATE('2012/03/11', 'YYYY/MM/DD'), 6, TO_DATE('2012/10/25', 'YYYY/MM/DD'), 'Vancouver Trolley');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (27, 'TROLLEY', TO_DATE('2012/03/11', 'YYYY/MM/DD'), 6, TO_DATE('2012/10/25', 'YYYY/MM/DD'), 'Vancouver Trolley');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (28, 'TROLLEY', TO_DATE('2012/03/11', 'YYYY/MM/DD'), 6, TO_DATE('2012/10/25', 'YYYY/MM/DD'), 'Vancouver Trolley');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (29, 'TROLLEY', TO_DATE('2012/03/11', 'YYYY/MM/DD'), 6, TO_DATE('2012/10/25', 'YYYY/MM/DD'), 'Vancouver Trolley');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (30, 'TROLLEY', TO_DATE('2012/03/11', 'YYYY/MM/DD'), 6, TO_DATE('2012/10/25', 'YYYY/MM/DD'), 'Vancouver Trolley');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (31, 'SEABUS', TO_DATE('1994/02/28', 'YYYY/MM/DD'), 24, TO_DATE('1997/04/30', 'YYYY/MM/DD'), 'Vancouver Harbor');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (32, 'SEABUS', TO_DATE('1994/02/28', 'YYYY/MM/DD'), 24, TO_DATE('1997/04/30', 'YYYY/MM/DD'), 'Vancouver Harbor');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (33, 'METRO', TO_DATE('2008/08/03', 'YYYY/MM/DD'), 11, TO_DATE('2009/03/17', 'YYYY/MM/DD'), 'Richmond Metro');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (34, 'METRO', TO_DATE('2008/08/03', 'YYYY/MM/DD'), 12, TO_DATE('2009/03/17', 'YYYY/MM/DD'), 'Richmond Metro');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (35, 'METRO', TO_DATE('2008/08/03', 'YYYY/MM/DD'), 16, TO_DATE('2009/03/17', 'YYYY/MM/DD'), 'Richmond Metro');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (36, 'METRO', TO_DATE('2008/08/03', 'YYYY/MM/DD'), 15, TO_DATE('2009/03/17', 'YYYY/MM/DD'), 'Burnaby Metro');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (37, 'METRO', TO_DATE('2008/08/03', 'YYYY/MM/DD'), 11, TO_DATE('2009/03/17', 'YYYY/MM/DD'), 'Burnaby Metro');
INSERT INTO Vehicle (ID, TYPE, ENTEREDSERVICE, SERVICEFREQUENCY, LASTSERVICEDATE, GARAGENAME) VALUES (38, 'RAIL', TO_DATE('2008/08/03', 'YYYY/MM/DD'), 19, TO_DATE('2009/03/17', 'YYYY/MM/DD'), 'Coquitlam Rail Yard');
INSERT INTO VehicleLicense (VEHICLEID, VEHICLETYPE, LICENSEDTYPE) VALUES (1, 'BUS', 'Class 1 Bus');
INSERT INTO VehicleLicense (VEHICLEID, VEHICLETYPE, LICENSEDTYPE) VALUES (24, 'RAPIDBUS', 'Class 1 Long Bus');
INSERT INTO VehicleLicense (VEHICLEID, VEHICLETYPE, LICENSEDTYPE) VALUES (26, 'TROLLEY', 'Class 1 Trolley');
INSERT INTO VehicleLicense (VEHICLEID, VEHICLETYPE, LICENSEDTYPE) VALUES (31, 'SEABUS', 'Passenger Vessel - Captain');