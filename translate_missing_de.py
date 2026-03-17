import urllib.request
import urllib.parse
import json
import time
import os

def translate_text(text, target_language):
    url = f"https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl={target_language}&dt=t&q={urllib.parse.quote(text)}"
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    for _ in range(3):
        try:
            with urllib.request.urlopen(req) as response:
                res = json.loads(response.read().decode('utf-8'))
                return "".join([part[0] for part in res[0]])
        except Exception as e:
            time.sleep(1)
    print(f"Error translating '{text[:15]}': {e}")
    return text

en_file = r'C:\sites\audit-tool-app\lang\en.json'
de_file = r'C:\sites\audit-tool-app\lang\de.json'

with open(en_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

with open(de_file, 'r', encoding='utf-8') as f:
    de_data = json.load(f)

added_count = 0
for en_key in en_data:
    if en_key not in de_data:
        print(f"Translating: {en_key[:30]}...")
        de_data[en_key] = translate_text(en_key, 'de')
        added_count += 1
        if added_count % 10 == 0:
            # Save progress incrementally
            with open(de_file, 'w', encoding='utf-8') as f:
                json.dump(de_data, f, indent=4, ensure_ascii=False)

with open(de_file, 'w', encoding='utf-8') as f:
    json.dump(de_data, f, indent=4, ensure_ascii=False)

print(f"Finished. Translated and added {added_count} strings to de.json.")
