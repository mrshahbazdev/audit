import json
import os

target_langs = {'de': 'Deutsch', 'es': 'Español', 'fr': 'Français', 'it': 'Italiano', 'pt': 'Português', 'ru': 'Русский', 'zh': '中文', 'ja': '日本語', 'ar': 'العربية'}

input_file = r'C:\sites\audit-tool-app\lang\en.json'
output_dir = r'C:\sites\audit-tool-app\lang'

with open(input_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

for lang_code, lang_name in target_langs.items():
    output_file = os.path.join(output_dir, f'{lang_code}.json')
    translated = {}
    for k, v in en_data.items():
        translated[k] = f'[{lang_code.upper()}] {v}'
    
    with open(output_file, 'w', encoding='utf-8') as out:
        json.dump(translated, out, ensure_ascii=False, indent=4)
    print(f'Generated {output_file}')
