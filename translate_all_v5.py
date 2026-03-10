import urllib.request
import urllib.parse
import json
import time
import os
from concurrent.futures import ThreadPoolExecutor

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

target_langs = {
    'de': 'de', 'es': 'es', 'fr': 'fr', 'it': 'it',
    'pt': 'pt', 'ru': 'ru', 'zh': 'zh-CN', 'ja': 'ja', 'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

def process_lang(lang_tuple):
    lang_code, google_code = lang_tuple
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    if os.path.exists(output_file) and os.path.getsize(output_file) > 1000:
        print(f"Skipping {lang_code}")
        return
    
    print(f"Translating to {lang_code}...")
    translated_data = {}
    
    strings = list(en_data.keys())
    # Use threads to speed up within each language as well? Actually, just do requests sequentially per language,
    # but run all languages in parallel.
    for i, orig in enumerate(strings):
        translated_data[orig] = translate_text(orig, google_code)
        if i % 100 == 0:
            print(f"{lang_code}: {i}/{len(strings)}")
            
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")

with ThreadPoolExecutor(max_workers=9) as executor:
    executor.map(process_lang, target_langs.items())

print("All done!")
