import translators as ts
import json
import os
import time

target_langs = {
    'de': 'de', 'es': 'es', 'fr': 'fr', 'it': 'it',
    'pt': 'pt', 'ru': 'ru', 'zh': 'zh-CN', 'ja': 'ja', 'ar': 'ar'
}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)
keys = list(en_data.keys())

# Define providers to rotate
providers = ['bing', 'google', 'alibaba']

for lang_code, tl_code in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    print(f"Translating to {lang_code}...")
    translated_data = {}
    
    for i, text in enumerate(keys):
        translation = text
        success = False
        
        for provider in providers:
            try:
                # Use ts.translate_text without printing internals
                res = ts.translate_text(text, translator=provider, from_language='en', to_language=tl_code)
                if res and isinstance(res, str):
                    translation = res
                    success = True
                    break
            except Exception as e:
                time.sleep(1)
                
        if not success:
            print(f"  Failed all providers for: {text[:20]}...")
            
        translated_data[text] = translation
        
        if i % 50 == 0:
            print(f"  {i}/{len(keys)}")
            
        time.sleep(0.5)
        
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(translated_data, f, indent=4, ensure_ascii=False)
    print(f"Finished {lang_code}")

print("All translations completed with translators package!")
