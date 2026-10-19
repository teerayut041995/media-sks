#!/usr/bin/env python3
"""Build offline, public-only preview data from the saved browser audit."""
import csv
import json
import re
from collections import Counter
from pathlib import Path
from urllib.parse import parse_qs, urlparse

ROOT = Path(__file__).resolve().parents[1]
AUDIT = ROOT / 'docs/live-site-audit-2026-10-14'
CATEGORIES = {
    '6494479976512721': 'ประชาสัมพันธ์',
    '7504392668518316': 'รางวัลและผลงาน',
    '1633925244228380': 'คลังความรู้',
    '1836317559281867': 'ดาวน์โหลด',
}
MONTHS = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
          'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
rows = list(csv.DictReader((AUDIT / 'page-inventory.csv').open(encoding='utf-8-sig')))
category_by_uid = {}
thumbnail_by_uid = {}
for row in rows:
    parsed = urlparse(row['requested_url'])
    params = parse_qs(parsed.query)
    if parsed.path != '/posts' or 'sub_category' in params:
        continue
    category = CATEGORIES.get(params.get('category', [''])[0])
    if not category:
        continue
    snapshot = json.loads((AUDIT / row['snapshot']).read_text())
    counts = Counter(x['url'] for x in snapshot['links'] if '/posts/' in x['url'])
    # Cards have title/image/read links; sidebar destinations appear only once.
    for url, count in counts.items():
        if count >= 2:
            category_by_uid[urlparse(url).path.rsplit('/', 1)[-1]] = category

home = json.loads((AUDIT / '0001.json').read_text())
thumbs = [i['src'] for i in home['images'] if '/image_post/thumbnail/' in i['src']]
latest_ids = ['2448482059092676', '2676572962299823', '8734159223280636',
              '4880908304262960', '8372667123393814', '5200260212700590']
thumbnail_by_uid.update(zip(latest_ids, thumbs[:6]))

records = []
for row in rows:
    kind = row['type']
    if kind not in ['ข่าว/บทความหลัก', 'รายละเอียดกิจกรรม', 'รายละเอียดหน่วยบริการ']:
        continue
    snapshot = json.loads((AUDIT / row['snapshot']).read_text())
    text = snapshot['mainText']
    uid = urlparse(row['requested_url']).path.rsplit('/', 1)[-1]
    title = snapshot['title'].split(' | ')[0]
    category = category_by_uid.get(uid, 'ประชาสัมพันธ์')
    if kind == 'รายละเอียดกิจกรรม':
        category = 'กิจกรรม'
        date_text = text.split('กิจกรรม\nวันที่\n')[-1] if 'กิจกรรม\nวันที่\n' in text else text
        body = re.sub(r'^(?:' + re.escape(title) + r'\s*)+', '', text)
        body = body.split('\nกิจกรรม\nวันที่')[0]
    elif kind == 'รายละเอียดหน่วยบริการ':
        category = 'หน่วยบริการ'
        date_text = ''
        # The existing service descriptions contain inconsistent location copy.
        body = title + ' ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ ดูข้อมูลและช่องทางติดต่อหน่วยบริการ'
    else:
        date_text = text
        body = re.split(r'จำนวนการเข้าชม\s*[\d,]+\s*ครั้ง', text, maxsplit=1)[-1]
    body = body.split('เนื้อหาที่เกี่ยวข้อง')[0].split('งานประชาสัมพันธ์ :')[0]
    paragraphs = list(dict.fromkeys(
        re.sub(r'\s+', ' ', paragraph).strip()
        for paragraph in re.split(r'\n\s*\n', body.strip()) if paragraph.strip()
    ))
    # Some source pages repeat their excerpt above the complete paragraph.
    paragraphs = [paragraph for paragraph in paragraphs
                  if not any(paragraph != other and paragraph in other for other in paragraphs)]
    summary = re.sub(r'\s+', ' ', body).strip()[:420]
    match = re.search(r'(\d{1,2})\s+(' + '|'.join(map(re.escape, MONTHS)) + r')\s+(\d{4})', date_text)
    if match:
        day, month, year = match.groups()
        date = f'{int(year)-543:04d}-{MONTHS.index(month)+1:02d}-{int(day):02d}'
        display_date = f'{int(day)} {month} {year}'
    else:
        date, display_date = '', ''
    image = next((i['src'] for i in snapshot['images'] if '/images/image_post/' in i['src']
                  or '/images/image_event/' in i['src']), '')
    records.append({'id': uid, 'type': category, 'title': title, 'summary': summary,
                    'paragraphs': paragraphs,
                    'date': date, 'display_date': display_date, 'url': row['requested_url'],
                    'image': image, 'thumbnail': thumbnail_by_uid.get(uid, image)})

records += [
    {'id': 'about', 'type': 'ข้อมูลศูนย์', 'title': 'รู้จักศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์',
     'summary': 'จัดการศึกษาเพื่อเด็กพิการ บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม ก่อตั้งเมื่อวันที่ 31 กรกฎาคม พ.ศ. 2543',
     'date': '', 'display_date': '', 'url': 'https://sks.go.th/about/history', 'image': '', 'thumbnail': ''},
    {'id': 'executive', 'type': 'ข้อมูลศูนย์', 'title': 'ผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์',
     'summary': 'รายชื่อและข้อมูลผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์',
     'date': '', 'display_date': '', 'url': 'https://sks.go.th/about/executive', 'image': '', 'thumbnail': ''},
    {'id': 'contact', 'type': 'ข้อมูลศูนย์', 'title': 'ติดต่อศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์',
     'summary': 'เลขที่ 400 หมู่ 1 ถนนถีนานนท์ ตำบลยางตลาด อำเภอยางตลาด จังหวัดกาฬสินธุ์ 46120 โทรศัพท์ 043-840-099 อีเมล ksped400@gmail.com',
     'date': '', 'display_date': '', 'url': 'https://sks.go.th/contact', 'image': '', 'thumbnail': ''},
]
assert len(records) == 679
assert len({r['id'] for r in records}) == len(records)
payload = {
    'source': 'https://sks.go.th/', 'captured_at': '2026-10-14', 'verified_home_at': '2026-10-15',
    'note': 'Frozen public titles, summaries, paragraphs, dates and source URLs; no database or runtime scraping.',
    'home': {'latest': latest_ids,
             'awards': ['4512907466978141', '3795588585100855', '3329595437524480'],
             'events': ['4557258015376265', '6761955739092727', '4492559071812991'],
             'documents': ['7763027791698328'],
             'banners': [
                 {'image': 'https://sks.go.th/images/banner/f3550a96058f4a15697b7780d4f5399e.png',
                  'background': '#edf5fb',
                  'alt': 'แบนเนอร์ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์'},
                 {'image': 'https://sks.go.th/images/banner/25a770915644f5e0cb0b4ed8bf32862d.png',
                  'background': '#000000',
                  'alt': 'น้อมส่งเสด็จสู่สวรรคาลัย สมเด็จพระนางเจ้าสิริกิติ์ พระบรมราชินีนาถ พระบรมราชชนนีพันปีหลวง'},
             ]},
    'records': records,
}
(ROOT / 'resources/data/home-preview.json').write_text(json.dumps(payload, ensure_ascii=False, indent=2) + '\n')
print(f'Wrote {len(records)} offline records; classified {len(category_by_uid)} posts.')
