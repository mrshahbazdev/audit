import re
import json
import os

seeder_path = r'C:\sites\audit-tool-app\database\seeders\DatabaseSeeder.php'
en_json_path = r'C:\sites\audit-tool-app\lang\en.json'

with open(seeder_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Pattern to find 'question' => '...', 'description' => '...', 'recommendation' => '...'
# Also handle different quote styles and potential newlines (though unlikely in this seeder)
patterns = [
    r"'question'\s*=>\s*(['\"])(.*?)\1",
    r"'description'\s*=>\s*(['\"])(.*?)\1",
    r"'recommendation'\s*=>\s*(['\"])(.*?)\1",
    r"'failure_recommendation'\s*=>\s*(['\"])(.*?)\1",
]

strings = set()

for p in patterns:
    matches = re.findall(p, content, re.DOTALL)
    for quote, text in matches:
        # Clean up escapes if any
        text = text.replace("\\'", "'").replace('\\"', '"')
        strings.add(text.strip())

# Also extract pillar names
pillar_pattern = r"'name'\s*=>\s*(['\"])(.*?)\1"
pillar_matches = re.findall(pillar_pattern, content)
for quote, text in pillar_matches:
    strings.add(text.strip())

if os.path.exists(en_json_path):
    with open(en_json_path, 'r', encoding='utf-8') as f:
        en_data = json.load(f)
else:
    en_data = {}

added_count = 0
for s in strings:
    if s and s not in en_data:
        en_data[s] = s
        added_count += 1

with open(en_json_path, 'w', encoding='utf-8') as f:
    json.dump(en_data, f, indent=4, ensure_ascii=False)

print(f"Extracted {len(strings)} unique strings. Added {added_count} new strings to en.json.")
