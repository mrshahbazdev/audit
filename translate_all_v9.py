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

for lang_code, google_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    print(f"Translating {lang_code} sequentially...")
    translated = {}
    translator = GoogleTranslator(source='en', target=google_code)
    
    for i, (k, v) in enumerate(en_data.items()):
        try:
            # Simple direct string translation
            translated[k] = translator.translate(str(k))
        except Exception as e:
            print(f"Failed {k[:20]}: {e}")
            translated[k] = f"[{lang_code.upper()}] {k}"
        
        if i % 100 == 0:
            print(f"  {lang_code}: {i}/{len(en_data)}")
        time.sleep(0.1)  # small delay to prevent rapid blocking
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")

print("All translations completed with sequential deep-translator!")
