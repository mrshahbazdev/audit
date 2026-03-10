import urllib.request
import urllib.parse
import json
import time
import os

def translate_text(text, target_language):
    url = f"https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl={target_language}&dt=t&q={urllib.parse.quote(text)}"
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    try:
        with urllib.request.urlopen(req) as response:
            res = json.loads(response.read().decode('utf-8'))
            return "".join([part[0] for part in res[0]])
    except Exception as e:
        print(f"Error translating '{text[:15]}': {e}")
        return text

target_langs = {
    'de': 'de', 'es': 'es', 'fr': 'fr', 'it': 'it',
    'pt': 'pt', 'ru': 'ru', 'zh': 'zh', 'ja': 'ja', 'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

for lang_code, google_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    if os.path.exists(output_file):
        print(f"Skipping {lang_code}")
        continue
    
    print(f"Translating to {lang_code}...")
    translated_data = {}
    
    for i, orig in enumerate(en_data.keys()):
        translated_data[orig] = translate_text(orig, google_code)
        if i % 50 == 0:
            print(f" {i}/{len(en_data)}")
        time.sleep(0.2)
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")
