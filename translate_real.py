import json
import os
import time
from deep_translator import GoogleTranslator

target_langs = {
    'de': 'de', 'es': 'es', 'fr': 'fr', 'it': 'it',
    'pt': 'pt', 'ru': 'ru', 'zh': 'zh-CN', 'ja': 'ja', 'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)
keys = list(en_data.keys())

for lang_code, google_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    
    print(f"Translating to {lang_code} ({google_code})...")
    translator = GoogleTranslator(source='en', target=google_code)
    translated_data = {}
    batch_size = 30
    
    for i in range(0, len(keys), batch_size):
        batch = keys[i:i+batch_size]
        try:
            t_batch = translator.translate_batch(batch)
            for k, v in zip(batch, t_batch):
                translated_data[k] = v
        except Exception as e:
            print(f"Batch {i} error in {lang_code}: {e}")
            for k in batch:
                try:
                    translated_data[k] = translator.translate(k)
                except Exception as ex:
                    translated_data[k] = k
                time.sleep(0.5)
        time.sleep(1)
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")

print("All real translations completed.")
