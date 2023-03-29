CREATE TABLE Account( 
  ID NUMBER(10) NOT NULL, 
  email VARCHAR(50) NOT NULL, 
  name VARCHAR(50),
  CONSTRAINT Account_pk PRIMARY KEY (ID),
  CONSTRAINT Account_uq UNIQUE (email)
); 

CREATE SEQUENCE add_account_id
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

CREATE TABLE BusCard(
  cardNum NUMBER(10) NOT NULL,
  balance BINARY_DOUBLE,
  cardType VARCHAR(6),
  ID NUMBER(10) NOT NULL,
  CONSTRAINT BusCard_pk PRIMARY KEY (ID, cardNum),
  Constraint BusCard_fk FOREIGN KEY (ID) REFERENCES Account(ID) ON DELETE CASCADE
);

CREATE TABLE Stop( 
  num NUMBER(10) NOT NULL, 
  lat BINARY_DOUBLE,
  lon BINARY_DOUBLE,
  name VARCHAR(50),
  CONSTRAINT Stop_pk PRIMARY KEY (num) 
); 


CREATE TABLE Visited( 
  accountID NUMBER(10) NOT NULL, 
  stopNum NUMBER(10) NOT NULL, 
  visitedDate DATE, 
  CONSTRAINT Visited_pk PRIMARY KEY (accountID, stopNUM, visitedDate), 
  CONSTRAINT Acct_fk 
    FOREIGN KEY (accountID) 
    REFERENCES Account(ID) 
    ON DELETE CASCADE, 
  CONSTRAINT VisitedStop_fk
    FOREIGN KEY (stopNum) 
    REFERENCES Stop(num) 
    ON DELETE CASCADE 
); 


CREATE TABLE PointOfInterest( 
  addr VARCHAR(70), 
  name VARCHAR(20), 
  rating BINARY_DOUBLE, 
  CONSTRAINT POI_pk PRIMARY KEY (addr,name) 
); 


CREATE TABLE School( 
  poiAddr VARCHAR(70), 
  poiName VARCHAR(20), 
  schoolType VARCHAR(20), 
  numStudents NUMBER(10), 
  CONSTRAINT School_pk PRIMARY KEY (poiAddr, poiName), 
  CONSTRAINT POI_scl_fk
    FOREIGN KEY (poiAddr, poiName) 
    REFERENCES PointOfInterest(addr,name) 
    ON DELETE CASCADE 
); 

CREATE TABLE HasPlayground( 
  parkStatus VARCHAR(20), 
  hasPlayground CHAR(1),
  CONSTRAINT HasPg_pk PRIMARY KEY (parkStatus)
); 


CREATE TABLE Park( 
  poiAddr VARCHAR(70), 
  poiName VARCHAR(20), 
  parkStatus VARCHAR(20), 
  CONSTRAINT Park_pk PRIMARY KEY (poiAddr, poiName), 
  CONSTRAINT POI_Park_fk 
    FOREIGN KEY (poiAddr, poiName) 
    REFERENCES PointOfInterest(addr,name) 
    ON DELETE CASCADE, 
  CONSTRAINT ParkSt_fk 
    FOREIGN KEY (parkStatus) 
    REFERENCES HasPlayground(parkStatus) 
); 
  

CREATE TABLE Restaurant( 
  poiAddr VARCHAR(70), 
  poiName VARCHAR(20), 
  capacity NUMBER(10), 
  cuisine VARCHAR(20), 
  CONSTRAINT Restaurant_pk PRIMARY KEY (poiAddr, poiName), 
  CONSTRAINT POI_Rest_fk
    FOREIGN KEY (poiAddr, poiName) 
    REFERENCES PointOfInterest(addr,name) 
    ON DELETE CASCADE 
); 
 

CREATE TABLE Attraction( 
  poiAddr VARCHAR(70), 
  poiName VARCHAR(20), 
  price NUMBER(10), 
  capacity NUMBER(10), 
  CONSTRAINT Attr_pk PRIMARY KEY (poiAddr, poiName), 
  CONSTRAINT POI_Attr_fk 
    FOREIGN KEY (poiAddr, poiName) 
    REFERENCES PointOfInterest(addr,name)  
    ON DELETE CASCADE 
); 


CREATE TABLE POIClosestTo( 
  poiAddr VARCHAR(70), 
  poiName VARCHAR(20), 
  stopNum NUMBER(10), 
  distanceFrom NUMBER(10), 
  CONSTRAINT POIClosest_pk PRIMARY KEY (poiAddr, poiName), 
  CONSTRAINT POI_Closest_fk 
    FOREIGN KEY (poiAddr, poiName) 
    REFERENCES PointOfInterest(addr,name) 
    ON DELETE CASCADE, 
  CONSTRAINT stop_fk
    FOREIGN KEY (stopNum) 
    REFERENCES Stop(num) 
); 
 
CREATE TABLE VehicleType(
  type VARCHAR(8), 
  topSpeed NUMBER(10), 
  capacity NUMBER(10), 
  frequency NUMBER(10),
  CONSTRAINT VehcileType_pk PRIMARY KEY (type),
); 


CREATE TABLE Garage( 
  name VARCHAR(50) NOT NULL, 
  capacity NUMBER(10), 
  type VARCHAR(8), 
  CONSTRAINT Garage_pk PRIMARY KEY (name),
  CONSTRAINT Type_fk
    FOREIGN KEY (type) 
    REFERENCES VehicleType(type) 
); 


CREATE TABLE TransitLine( 
  lineCode VARCHAR(20) NOT NULL, 
  lineName VARCHAR(50),
  garageName VARCHAR(50), 
  startStop NUMBER(10), 
  endStop NUMBER(10),
  CONSTRAINT transitLine_pk PRIMARY KEY (lineCode),
  CONSTRAINT LineGarage_fk
    FOREIGN KEY (garageName) 
    REFERENCES Garage(name), 
  CONSTRAINT startStop_fk
    FOREIGN KEY (startStop) 
    REFERENCES Stop(num), 
  CONSTRAINT endStop_fk
    FOREIGN KEY (endStop) 
    REFERENCES Stop(num) 
); 


CREATE TABLE LineStops( 
  lineCode VARCHAR(20), 
  stopNum NUMBER(10), 
  stopOrder NUMBER(10),
  CONSTRAINT LineStops_pk PRIMARY KEY (lineCode, stopNum),
  CONSTRAINT line_fk 
    FOREIGN KEY (lineCode) 
    REFERENCES TransitLine(lineCode)  
    ON DELETE CASCADE, 
  CONSTRAINT LineStop_fk
    FOREIGN KEY (stopNum) 
    REFERENCES Stop(num) 
    ON DELETE CASCADE
); 


CREATE TABLE Vehicle(
  ID NUMBER(10) NOT NULL, 
  type VARCHAR(20) NOT NULL, 
  enteredService DATE, 
  serviceFrequency NUMBER(10), 
  lastServiceDate DATE, 
  garageName VARCHAR(50),  
  CONSTRAINT Vehicle_pk PRIMARY KEY (ID, type), 
  CONSTRAINT VehicleGarage_fk FOREIGN KEY (garageName) REFERENCES Garage(name), 
  CONSTRAINT VehicleType_fk FOREIGN KEY (type) REFERENCES VehicleType(type)
);  



CREATE TABLE Operator( 
  ID NUMBER(10) NOT NULL, 
  name VARCHAR(50), 
  garageName VARCHAR(50), 
  vehicleID NUMBER(10), 
  vehicleType VARCHAR(20), 
  workingLine VARCHAR(20), 
  CONSTRAINT Operator_pk PRIMARY KEY (ID),
  CONSTRAINT Garage_fk
    FOREIGN KEY (garageName) 
    REFERENCES Garage(name), 
  CONSTRAINT OperatorVehicle_fk
    FOREIGN KEY (vehicleID, vehicleType) 
    REFERENCES Vehicle(ID, type), 
  CONSTRAINT OperatorLine_fk
    FOREIGN KEY (workingLine) 
    REFERENCES TransitLine(lineCode), 
  CONSTRAINT VehicleTypeOperator_fk
    FOREIGN KEY (vehicleType)
    REFERENCES VehicleType(type)
); 
 
CREATE TABLE VehicleLicense( 
  vehicleID NUMBER(10), 
  vehicleType VARCHAR(20), 
  licensedType VARCHAR(50), 
  CONSTRAINT VehicleLicense_pk PRIMARY KEY (vehicleID, vehicleType), 
  CONSTRAINT Vehicle_fk 
    FOREIGN KEY (vehicleID, vehicleType) 
    REFERENCES Vehicle(ID, type) 
    ON DELETE CASCADE 
); 
 

CREATE TABLE HasWorked( 
  lineCode VARCHAR(20), 
  operatorID NUMBER(10), 
  CONSTRAINT HasWorked_pk PRIMARY KEY (lineCode, operatorID), 
  CONSTRAINT HasWorkedline_fk
    FOREIGN KEY (lineCode) 
    REFERENCES TransitLine(lineCode)  
    ON DELETE CASCADE, 
  CONSTRAINT Operator_fk
    FOREIGN KEY (operatorID) 
    REFERENCES Operator(ID) 
    ON DELETE CASCADE 
); 