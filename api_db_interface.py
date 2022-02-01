from base64 import decode, encode
from email.mime import nonmultipart
import requests
import xml.etree.ElementTree as et
import pymysql


def insert_in_db(lng,lat):
    db_conn = pymysql.connect(host='localhost', user='wordpress', password='root', charset='utf8', db='wordpress')
    cur = db_conn.cursor()
    sql_str = """insert into `locations` (lat,lng)values (%s, %s) """
    cur.execute(sql_str,(lat,lng))
    db_conn.commit()
    db_conn.close()

url = "https://api.3geonames.org/randomland"
for i in range(1,10000):
    resp = requests.get(url)
    resp_tree = None
    if not resp.ok:
        continue
    resp_tree = et.fromstring(resp.content.decode("utf-8"))
    latt = ""
    lng = ""
    for child in resp_tree[0]:
        if lng!="" and latt != "":
            break
        if child.tag == "latt":
            latt = child.text
            continue
        if child.tag == "longt":
            lng = child.text
            continue
    if lng == "" and latt == "":
            continue
    insert_in_db(lng,latt)