import requests
from bs4 import BeautifulSoup
import pandas as pd
import pymysql


base_url = "https://www.premierleague.com/tables"

url = base_url

resp = requests.get(url)
html = resp.text

soup = BeautifulSoup(html, "html.parser")

ranks = soup.select('span[class=value]')[:20]
teams = soup.select('span[class="short"]')[:20]
wons = soup.select('td:nth-child(5)')[:20]
draws = soup.select('td:nth-child(6)')[:20]
losts = soup.select('td:nth-child(7)')[:20]
gfs = soup.select('td:nth-child(8)')[:20]
gas = soup.select('td:nth-child(9)')[:20]
gds = soup.select('td:nth-child(10)')[:20]
pointgang = soup.select('td[class=points]')[:20]    ##mainContent > div.tabbedContent > div.mainTableTab.active > div.allTablesContainer > div > div > div > table > tbody > tr.tableDark > td.points


rank=[]
team=[]
won=[]
draw=[]
lost=[]
gf=[]
ga=[]
gd=[]
points=[]

for item in ranks:
    #print(item.text)
    rank.append(item.text)
for item in teams:
    #print(item.text)
    team.append(item.text)
for item in wons:
    #print(item.text)
    won.append(item.text)
for item in draws:
    #print(item.text)
    draw.append(item.text)
for item in losts:
    #print(item.text)
    lost.append(item.text)
for item in gfs:
    #print(item.text)
    gf.append(item.text)
for item in gas:
    #print(item.text)
    ga.append(item.text)
for item in gds:
    #print(item.text)
    gd.append(item.text.replace("\n","").replace(" ",""))
for item in pointgang:
    #print(item.text)
    points.append(item.text)



print(rank)
print(team)
print(won)
print(draw)
print(lost)
print(gf)
print(ga)
print(gd)
print(points)

conn = pymysql.connect(host='localhost',user='seokbangguri',password='dlaoehdrodtmxj1!',db='test',charset='utf8')
cur = conn.cursor()
cur.execute("delete from ranking")
for i in range(20):
    cur.execute("insert into ranking (rank,team,won,draw,lost,gf,ga,gd,points) values('{}','{}','{}','{}','{}','{}','{}','{}','{}')".format(rank[i],team[i],won[i],draw[i],lost[i],gf[i],ga[i],gd[i],points[i]))
    


conn.commit()
conn.close()
