import json
import os
import time
from googletrans import Translator

target_langs = {
    'de': 'de', 'es': 'es', 'fr': 'fr', 'it': 'it',
    'pt': 'pt', 'ru': 'ru', 'zh': 'zh-cn', 'ja': 'ja', 'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)
keys = list(en_data.keys())

translator = Translator()

for lang_code, google_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    print(f"Translating to {lang_code}...")
    translated_data = {}
    
    # We can batch with googletrans
    batch_size = 50
    for i in range(0, len(keys), batch_size):
        batch = keys[i:i+batch_size]
        try:
            translations = translator.translate(batch, dest=google_code, src='en')
            for j, orig in enumerate(batch):
                translated_data[orig] = translations[j].text
        except Exception as e:
            print(f"Error in batch {i}: {e}")
            for orig in batch:
                try:
                    res = translator.translate(orig, dest=google_code, src='en')
                    translated_data[orig] = res.text
                except Exception as ex:
                    translated_data[orig] = orig
        time.sleep(1)
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")

print("All translations completed with googletrans!")
