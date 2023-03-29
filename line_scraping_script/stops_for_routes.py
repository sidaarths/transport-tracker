import os

# DICT STRUCTURE
#{
#    id: {
#            code: <stop_code>
#            name: <stop_name>
#            lat: <stop_lat>
#            lon: <stop_lon>
#       }
#}
#
def make_stops_dict():
    f2 = open(os.getcwd() + "/google_transit/stops.txt", "r")
    stops_dict = {}
    for line in f2:
        stop_struct = {}
        splitLine = line.split(",")
        stop_struct["code"] = splitLine[1]
        stop_struct["name"] = splitLine[2]
        stop_struct["lat"] = splitLine[4]
        stop_struct["lon"] = splitLine[5]
        stops_dict[splitLine[0]] = stop_struct
    f2.close()
    return stops_dict

# DICT STRUCTURE
# {
#   <route_id>:{
#                 code:<route_code>
#                 name:<route_name>
#             }
# }
def make_lines_dict():
    f2 = open(os.getcwd() + "/filtered_routes.txt", "r")
    lines_dict = {}
    for line in f2:
        line_struct = {}
        splitLine = line.split(",")
        line_struct["code"] = splitLine[2]
        line_struct["name"] = splitLine[3]
        lines_dict[splitLine[0]] = line_struct
    f2.close()
    return lines_dict

# DICT STRUCTURE
# {<route_id>:<trip_id>}
def make_trips_dict():
    f2 = open(os.getcwd() + "/google_transit/trips.txt", "r")
    trips_dict = {}
    visited_routes = []
    for line in f2:
        splitLine = line.split(",")
        if(visited_routes.count(splitLine[0]) == 0):
            trips_dict[splitLine[0]] = splitLine[2]
            visited_routes.append(splitLine[0])
    f2.close()
    return trips_dict
       
def get_stops_for_routes(stops_dict, lines_dict, trips_dict):
    f2 = open(os.getcwd() + "/google_transit/stop_times.txt", "r")
    stops_and_trips = []
    line_stops_dict = {}
    for stop in f2:
        splitLine = stop.split(",")
        # tuple is (trip_id, stop_id, stop_seq)
        stops_and_trips.append((splitLine[0], splitLine[3], splitLine[4]))
    for key in lines_dict:
        # make a metadata dict
        line_metadata = {}
        line_code = (lines_dict[key])["code"]

        line_metadata["name"] = (lines_dict[key])["name"]
        line_metadata["stops"] = []
        print("Adding Line:",line_code,"...")

        trip_id = trips_dict[key]

        for elem in stops_and_trips:
            if(elem[0] == trip_id):
                stop_struct = stops_dict[elem[1]]
                stop_code = stop_struct["code"]
                line_metadata["stops"].append((stop_code, elem[2]))
        line_stops_dict[line_code] = line_metadata

    return line_stops_dict

def make_line_stop_SQL(line_stops_dict):
    f2 = open(os.getcwd() + "/output/line_stops_insert.sql", "w")
    for line_code in line_stops_dict:
        line_metadata = line_stops_dict[line_code]
        for stop_tuple in line_metadata["stops"]:
            f2.write(f"INSERT INTO LineStops values (\"{line_code}\",{stop_tuple[0]},{stop_tuple[1]});\n")
    f2.close()

def make_stop_SQL(stops_dict, line_stops_dict):
    f2 = open(os.getcwd() + "/output/stops_required_insert.sql", "w")
    stops_in_line_stops = []
    for line_code in line_stops_dict:
        line_metadata = line_stops_dict[line_code]
        for stop in line_metadata["stops"]:
            stops_in_line_stops.append(stop[0])
        
    for k in stops_dict:
        stop_struct = stops_dict[k]
        code = stop_struct["code"]
        name = stop_struct["name"]
        lat = stop_struct["lat"]
        lon = stop_struct["lon"]
        if(stops_in_line_stops.count(code) > 0):
            f2.write(f"INSERT INTO Stop values ({code},{lat},{lon},\"{name}\");\n")
    f2.close()

def make_line_SQL(line_stops_dict):
    f2 = open(os.getcwd() + "/output/lines_insert.sql", "w")
    for line_code in line_stops_dict:
        line_metadata = line_stops_dict[line_code]
        stops: list = line_metadata["stops"]
        first_stop = get_first_stop(stops)
        last_stop = get_last_stop(stops)
        name = line_metadata["name"]
        f2.write(f"INSERT INTO TransitLine values (\"{line_code}\",\"{name}\",\"\",{first_stop[0]},{last_stop[0]});\n")
    f2.close()

def get_first_stop(stops):
    minimum = (stops[0])
    for stop in stops:
        if stop[1] < minimum[1]:
            minimum = stop
    return minimum

def get_last_stop(stops):
    maximum = (stops[0])
    for stop in stops:
        if stop[1] > maximum[1]:
            maximum = stop
    return maximum


if __name__ == "__main__":
    try:
        os.mkdir(os.getcwd() + "/output")
    except:
        pass    
    stops_dict = make_stops_dict()
    lines_dict = make_lines_dict()
    trips_dict = make_trips_dict()
    line_stops_dict = get_stops_for_routes(stops_dict, lines_dict, trips_dict)
    print("making line SQL...")
    make_line_SQL(line_stops_dict)
    print("making stop SQL...")
    make_stop_SQL(stops_dict, line_stops_dict)
    print("making linestop SQL...")
    make_line_stop_SQL(line_stops_dict)