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
teams = soup.select('span[class="long"]')[:20]
wons = soup.select('td:nth-child(5)')[:20]
draws = soup.select('td:nth-child(6)')[:20]
losts = soup.select('td:nth-child(7)')[:20]
gfs = soup.select('td:nth-child(8)')[:20]
gas = soup.select('td:nth-child(9)')[:20]
gds = soup.select('td:nth-child(10)')[:20]
pointgang = soup.select('td[class=points]')[:20]

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

#news
head = 'https://search.naver.com/search.naver?where=news&query='
butt = "&sm=tab_opt&sort=1"
Arsenal = head+"아스날"+butt
ManchesterCity = head +"맨체스터시티"+butt
NewcastleUnited =head +"뉴캐슬유나이티드"+butt
TottenhamHotspur = head +"토트넘"+butt
ManchesterUnited = head +"맨체스터유나이티드"+butt
Liverpool = head +"리버풀"+butt
BrightonandHove  = head +"브라이튼호브알비온"+butt
Chelsea = head +"첼시"+butt
Fulham = head +"풀럼"+butt
Brentford = head +"브렌트포드"+butt
CrystalPalace = head +"크리스탈팰리스"+butt
AstonVilla = head +"아스턴빌라"+butt
LeicesterCity = head +"레스터시티"+butt
Bournemouth = head +"본머스"+butt
LeedsUnited = head +"리즈유나이티드"+butt
WestHamUnited = head +"웨스트햄"+butt
Everton = head +"에버튼"+butt
NottinghamForest = head +"노팅엄"+butt
Southampton = head +"사우스햄튼"+butt
WolverhamptonWanderers = head +"울버햄튼"+butt

def findteam(skull):
    if skull == Arsenal:
        return "Arsenal"
    elif skull == ManchesterCity:
        return "Manchester City"
    elif skull == NewcastleUnited:
        return "Newcastle United"
    elif skull == TottenhamHotspur:
        return "Tottenham Hotspur"
    elif skull == ManchesterUnited:
        return "Manchester United"
    elif skull == Liverpool:
        return "Liverpool"
    elif skull == BrightonandHove :
        return "Brighton and Hove Albion"
    elif skull == Chelsea:
        return "Chelsea"
    elif skull == Fulham:
        return "Fulham"
    elif skull == Brentford:
        return "Brentford"
    elif skull == CrystalPalace:
        return "Crystal Palace"
    elif skull == AstonVilla:
        return "Aston Villa"
    elif skull == LeicesterCity:
        return "Leicester City"
    elif skull == Bournemouth:
        return "Bournemouth"
    elif skull == LeedsUnited:
        return "Leeds United"
    elif skull == WestHamUnited:
        return "West Ham United"
    elif skull == Everton:
        return "Everton"
    elif skull == NottinghamForest:
        return "Nottingham Forest"
    elif skull == Southampton:
        return "Southampton"
    elif skull == WolverhamptonWanderers:
        return "Wolverhampton Wanderers"

teams = [
Arsenal,
ManchesterCity,
NewcastleUnited,
TottenhamHotspur,
ManchesterUnited,
Liverpool,
BrightonandHove ,
Chelsea,
Fulham,
Brentford,
CrystalPalace,
AstonVilla,
LeicesterCity,
Bournemouth,
LeedsUnited,
WestHamUnited,
Everton,
NottinghamForest,
Southampton,
WolverhamptonWanderers
]

newsdate = []
newsname = []
newsbrand = []
newslink = []
newsteam = []

for t in range(len(teams)):
    resp = requests.get(teams[t])
    html = resp.text
    soup = BeautifulSoup(html, "html.parser")
    date = soup.select('span.info')[:5]
    for a in date:
        newsdate.append(a.text)
    name = soup.select('a.news_tit')[:5]
    for a in name:
        newsname.append(a.text[0:11])
    brand = soup.select('a.info.press')[:5]
    for a in brand:
        newsbrand.append(a.text)
    link = soup.select('a.news_tit')[:5]
    for a in link:
        a = a.get('href')
        newslink.append(a)
        newsteam.append(findteam(teams[t]))

conn = pymysql.connect(host='localhost',user='seokbangguri',password='dlaoehdrodtmxj1!',db='test',charset='utf8')
cur = conn.cursor()
cur.execute("delete from ranking")

for i in range(20):
    cur.execute("insert into ranking (rank,team,won,draw,lost,gf,ga,gd,points) values('{}','{}','{}','{}','{}','{}','{}','{}','{}')".format(rank[i],team[i],won[i],draw[i],lost[i],gf[i],ga[i],gd[i],points[i]))

for i in range(100):
    cur.execute("insert into news (date,name,link,brand,team) values('{}','{}','{}','{}','{}')".format(newsdate[i],newsname[i],newslink[i],newsbrand[i],newsteam[i]))


#for row in temp:
#    cur.execute("insert into ranking( rank,team,won,draw,lost,gf,ga,gd,points) values(null,{},null,null,null,null,null,null,null)".format(row))
#for row in team:
#    cur.execute("insert into ranking(team) values('{}','{}','{}','{}','{}','{}','{}','{}','{}')".format(rank[i]))
conn.commit()
conn.close()
