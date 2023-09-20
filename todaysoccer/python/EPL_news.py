import requests
from bs4 import BeautifulSoup
import pandas as pd
import pymysql

#news
head = 'https://search.naver.com/search.naver?where=news&query='
Arsenal = head+"아스날"
ManchesterCity = head +"맨체스터시티"
NewcastleUnited =head +"뉴캐슬유나이티드"
TottenhamHotspur = head +"토트넘"
ManchesterUnited = head +"맨체스터유나이티드"
Liverpool = head +"리버풀"
BrightonandHove  = head +"브라이튼호브알비온"
Chelsea = head +"첼시"
Fulham = head +"풀럼"
Brentford = head +"브렌트포드"
CrystalPalace = head +"크리스탈팰리스"
AstonVilla = head +"아스턴빌라"
LeicesterCity = head +"레스터시티"
Bournemouth = head +"본머스"
LeedsUnited = head +"리즈유나이티드"
WestHamUnited = head +"웨스트햄"
Everton = head +"에버튼"
NottinghamForest = head +"노팅엄"
Southampton = head +"사우스햄튼"
WolverhamptonWanderers = head +"울버햄튼"

def findteam(skull):
    if skull == Arsenal:
        return "ARS"
    elif skull == ManchesterCity:
        return "MCI"
    elif skull == NewcastleUnited:
        return "NEW"
    elif skull == TottenhamHotspur:
        return "TOT"
    elif skull == ManchesterUnited:
        return "MUM"
    elif skull == Liverpool:
        return "LIV"
    elif skull == BrightonandHove :
        return "BHA"
    elif skull == Chelsea:
        return "CHE"
    elif skull == Fulham:
        return "FUL"
    elif skull == Brentford:
        return "BRE"
    elif skull == CrystalPalace:
        return "CRY"
    elif skull == AstonVilla:
        return "AVL"
    elif skull == LeicesterCity:
        return "LEI"
    elif skull == Bournemouth:
        return "BOU"
    elif skull == LeedsUnited:
        return "LEE"
    elif skull == WestHamUnited:
        return "WHU"
    elif skull == Everton:
        return "EVE"
    elif skull == NottinghamForest:
        return "NFO"
    elif skull == Southampton:
        return "SOU"
    elif skull == WolverhamptonWanderers:
        return "WOL"

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
    date = soup.select('span.info')[:10]
    for a in date:
        newsdate.append(a.text)
    name = soup.select('a.news_tit')[:10]
    for a in name:
        newsname.append(a.text[0:11].replace("'","").replace(",",""))
    brand = soup.select('a.info.press')[:10]
    for a in brand:
        newsbrand.append(a.text)
    link = soup.select('a.news_tit')[:10]
    for a in link:
        a = a.get('href')
        newslink.append(a)
        newsteam.append(findteam(teams[t]))

print(len(newsdate ))
print(len(newsname ))
print(len(newsbrand))
print(len(newslink ))
print(len(newsteam ))
print(newsname)


conn = pymysql.connect(host='localhost',user='seokbangguri',password='dlaoehdrodtmxj1!',db='test',charset='utf8')
cur = conn.cursor()

cur.execute("delete from news")

for i in range(100):
    cur.execute("insert into news (date,name,link,brand,team) values('{}','{}','{}','{}','{}')".format(newsdate[i],newsname[i],newslink[i],newsbrand[i],newsteam[i]))

conn.commit()
conn.close()
