import json
import os
import time
from deep_translator import GoogleTranslator

target_langs = {
    'de': 'de',
    'es': 'es',
    'fr': 'fr',
    'it': 'it',
    'pt': 'pt',
    'ru': 'ru',
    'zh': 'zh-CN',
    'ja': 'ja',
    'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

for lang_code, google_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    if os.path.exists(output_file):
        print(f"Skipping {lang_code}, file exists.")
        continue
    
    print(f"Translating to {lang_code}...")
    translator = GoogleTranslator(source='en', target=google_code)
    
    translated_data = {}
    original_strings = list(en_data.keys())
    
    batch_size = 30
    for i in range(0, len(original_strings), batch_size):
        batch = original_strings[i:i+batch_size]
        try:
            translations = translator.translate_batch(batch)
            for j, orig in enumerate(batch):
                translated_data[orig] = translations[j]
        except Exception as e:
            print(f"Error in batch {i}: {e}")
            for orig in batch:
                try:
                    translated_data[orig] = translator.translate(orig)
                except Exception as ex:
                    print(f"Failed {orig}: {ex}")
                    translated_data[orig] = orig
        time.sleep(1.5)
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")
