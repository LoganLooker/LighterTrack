import pprint
import csv
from pymongo import MongoClient as mc
import random

client = mc('localhost', 27017)

db = client.LighterTracker

db.locations.drop()
db.lighters.drop()

locations = []
with open('cities.csv', 'r') as file:
    reader = csv.DictReader(file)
    for row in reader:
        tmp = {'zip' : int(row['zip']),
               'latlong' : [float(row['lat']), float(row['long'])],
               'name' : row['city'],
               'state': row['state']
               }
        locations.append(tmp)
        print 'tracking {}, {}'.format(row['city'], row['state'])

db.locations.insert(locations)

lighters = []
user = 1
for x in range(1, 20):
    tmpLighter = {'id' : x, 'history' : []}
    for i in range(random.randint(1, 10)):
        if random.randint(0, 1):
            user += 1
        if user not in (u['user_id'] for u in tmpLighter['history']):
            tmpLighter['history'].append({'user_id': user, 'locations': []})
        for j in range(len(tmpLighter['history'])):
            if tmpLighter['history'][j]['user_id'] == user:
                z = locations[random.randint(0, len(locations))]['zip']
                tmpLighter['history'][j]['locations'].append(z)
    lighters.append(tmpLighter)
    pprint.pprint(tmpLighter)

db.lighters.insert(lighters)

