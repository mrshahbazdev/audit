import json
import os
import time
from translate import Translator

target_langs = {
    'de': 'de',
    'es': 'es',
    'fr': 'fr',
    'it': 'it',
    'pt': 'pt',
    'ru': 'ru',
    'zh': 'zh',
    'ja': 'ja',
    'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

for lang_code, mymemory_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    if os.path.exists(output_file):
        print(f"Skipping {lang_code}, file exists.")
        continue
    
    print(f"Translating to {lang_code}...")
    translator = Translator(to_lang=mymemory_code, email="test@example.com")
    
    translated_data = {}
    
    for orig in en_data.keys():
        try:
            res = translator.translate(orig)
            translated_data[orig] = res
        except Exception as ex:
            print(f"Failed {orig} -> {ex}")
            translated_data[orig] = orig
        time.sleep(0.5)
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")
