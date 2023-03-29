INSERT INTO Operator VALUES (1, 'James Adams', 'Vancouver Trolley', 26, 'TROLLEY', '003');
INSERT INTO Operator VALUES (2, 'Michael Baker', 'Vancouver Trolley', 27, 'TROLLEY', '004');
INSERT INTO Operator VALUES (3, 'Robert Clark', 'Vancouver Trolley', 28, 'TROLLEY', '007');
INSERT INTO Operator VALUES (4, 'Maria Evans', 'Vancouver Trolley', 29, 'TROLLEY', '010');

INSERT INTO Operator VALUES (5, 'David Frank', 'Richmond Bus', 1, 'BUS', '408');
INSERT INTO Operator VALUES (6, 'Mary Ghosh', 'Richmond Bus', 2, 'BUS', '414');
INSERT INTO Operator VALUES (7, 'James Hills', 'Richmond Bus', 3, 'BUS', '406');
INSERT INTO Operator VALUES (8, 'Michael Irwin', 'Vancouver Bus', 7, 'BUS', '033');

INSERT INTO Operator VALUES (9, 'Robert Jones', 'Vancouver Harbor', 31, 'SEABUS', 'SeaBus');

INSERT INTO Operator VALUES (10, 'Maria Klein', 'Coquitlam Rail Yard', 38, 'RAIL', 'WCE');

INSERT INTO Operator VALUES (11, 'David Lopez', 'Richmond Metro', 33, 'METRO', 'Canada Line');
INSERT INTO Operator VALUES (12, 'Mary Mason', 'Richmond Metro', 34, 'METRO', 'Canada Line');
INSERT INTO Operator VALUES (13, 'James Nalty', 'Richmond Metro', 35, 'METRO', 'Canada Line');
INSERT INTO Operator VALUES (14, 'Michael Ochoa', 'Burnaby Metro', 36, 'METRO', 'Expo Line');
INSERT INTO Operator VALUES (15, 'Robert Quinn', 'Burnaby Metro', 37, 'METRO', 'Millenium Line');

INSERT INTO Operator VALUES (16, 'Maria Reily', 'Richmond Long Bus', 4, 'RAPIDBUS', '049');
INSERT INTO Operator VALUES (17, 'David Smith', 'Richmond Long Bus', 5, 'RAPIDBUS', '049');
INSERT INTO Operator VALUES (18, 'Mary Trott', 'Burnaby Long Bus', 13, 'RAPIDBUS', '084');
INSERT INTO Operator VALUES (19, 'Walter White', 'Burnaby Long Bus', 14, 'RAPIDBUS', '099');

INSERT INTO HasWorked VALUES ('003', 2);
INSERT INTO HasWorked VALUES ('007', 2);
INSERT INTO HasWorked VALUES ('010', 2);
INSERT INTO HasWorked VALUES ('004', 2);
INSERT INTO HasWorked VALUES ('016', 2);
INSERT INTO HasWorked VALUES ('017', 2);
INSERT INTO HasWorked VALUES ('019', 2);
INSERT INTO HasWorked VALUES ('020', 2);
INSERT INTO HasWorked VALUES ('003', 1);
INSERT INTO HasWorked VALUES ('007', 1);
INSERT INTO HasWorked VALUES ('010', 1);
INSERT INTO HasWorked VALUES ('004', 1);
INSERT INTO HasWorked VALUES ('016', 1);
INSERT INTO HasWorked VALUES ('017', 1);
INSERT INTO HasWorked VALUES ('019', 1);
INSERT INTO HasWorked VALUES ('020', 1);
INSERT INTO HasWorked VALUES ('010', 3); 
INSERT INTO HasWorked VALUES ('007', 4);
INSERT INTO HasWorked VALUES ('414', 5);
INSERT INTO HasWorked VALUES ('406', 5);
INSERT INTO HasWorked VALUES ('408', 7);
INSERT INTO HasWorked VALUES ('Expo Line', 15);
INSERT INTO HasWorked VALUES ('Millenium Line', 14);
INSERT INTO HasWorked VALUES ('084', 19);
INSERT INTO HasWorked VALUES ('049',19);
INSERT INTO HasWorked VALUES ('099',19);
INSERT INTO HasWorked VALUES ('R4',19);
INSERT INTO HasWorked VALUES ('R5',19);
INSERT INTO HasWorked VALUES ('084', 18);
INSERT INTO HasWorked VALUES ('049',18);
INSERT INTO HasWorked VALUES ('099',18);
INSERT INTO HasWorked VALUES ('R4',18);
INSERT INTO HasWorked VALUES ('R5',18);
INSERT INTO HasWorked VALUES ('084', 17);
INSERT INTO HasWorked VALUES ('049',17);
INSERT INTO HasWorked VALUES ('099',17);
INSERT INTO HasWorked VALUES ('R4',17);
INSERT INTO HasWorked VALUES ('R5',17);
INSERT INTO HasWorked VALUES ('Millenium Line', 15);
INSERT INTO HasWorked VALUES ('Canada Line', 15);
INSERT INTO HasWorked VALUES ('SeaBus', 10);