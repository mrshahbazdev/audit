import os
import re
import json

base_dirs = [
    r'C:\sites\audit-tool-app\resources\views',
    r'C:\sites\audit-tool-app\app',
    r'C:\sites\audit-tool-app\routes'
]

matches = set()
# Match __('String') or __("String")
pattern = re.compile(r"__\(\s*(['\"])(.*?)\1\s*(?:,|\))")

for base_dir in base_dirs:
    for root, dirs, files in os.walk(base_dir):
        for file in files:
            if file.endswith('.php'):
                with open(os.path.join(root, file), 'r', encoding='utf-8') as f:
                    content = f.read()
                    found = pattern.findall(content)
                    for quote, string in found:
                        matches.add(string)

result = {m: m for m in matches}
with open(r'C:\sites\audit-tool-app\lang\en.json', 'w', encoding='utf-8') as f:
    json.dump(result, f, indent=4, ensure_ascii=False)

print(f"Extracted {len(matches)} strings to lang/en.json")
