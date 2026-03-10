import json, os

lang_dir = r'C:\sites\audit-tool-app\lang'

# New exact Umsatz question strings (EN)
new_en = {
    "The necessary monthly turnover is defined and realistically planned.":
        "The necessary monthly turnover is defined and realistically planned.",
    "Does the company have a clear, written monthly revenue target that is realistic based on past data and current capacity?":
        "Does the company have a clear, written monthly revenue target that is realistic based on past data and current capacity?",
    "Suitable interested parties are continuously reached.":
        "Suitable interested parties are continuously reached.",
    "Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?":
        "Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?",
    "A sufficient proportion of leads become customers.":
        "A sufficient proportion of leads become customers.",
    "Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?":
        "Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?",
    "Services/deliveries will be as promised.":
        "Services/deliveries will be as promised.",
    "Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?":
        "Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?",
    "Customers comply with payment and cooperation obligations.":
        "Customers comply with payment and cooperation obligations.",
    "Do customers pay on time and cooperate as required (e.g., providing feedback, materials, or access) so the service can be completed?":
        "Do customers pay on time and cooperate as required (e.g., providing feedback, materials, or access) so the service can be completed?",
}

# Accurate German translations
de_new = {
    "The necessary monthly turnover is defined and realistically planned.":
        "Der notwendige monatliche Umsatz ist definiert und realistisch geplant.",
    "Does the company have a clear, written monthly revenue target that is realistic based on past data and current capacity?":
        "Verfügt das Unternehmen über ein klares, schriftliches monatliches Umsatzziel, das auf vergangenen Daten und der aktuellen Kapazität basiert?",
    "Suitable interested parties are continuously reached.":
        "Geeignete Interessenten werden kontinuierlich erreicht.",
    "Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?":
        "Verfügt das Unternehmen über ein zuverlässiges, aktives System zur kontinuierlichen Gewinnung qualifizierter Interessenten – nicht nur gelegentliche Kampagnen?",
    "A sufficient proportion of leads become customers.":
        "Ein ausreichender Anteil der Interessenten wird zu Kunden.",
    "Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?":
        "Ist die Konversionsrate vom Interessenten zum zahlenden Kunden hoch genug, um das geplante monatliche Umsatzziel zu erreichen?",
    "Services/deliveries will be as promised.":
        "Leistungen/Lieferungen erfolgen wie vereinbart.",
    "Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?":
        "Liefert das Unternehmen konsequent das, was verkauft wurde – pünktlich, in der vereinbarten Qualität und ohne Abstriche?",
    "Customers comply with payment and cooperation obligations.":
        "Kunden halten Zahlungs- und Kooperationspflichten ein.",
    "Do customers pay on time and cooperate as required (e.g., providing feedback, materials, or access) so the service can be completed?":
        "Zahlen Kunden pünktlich und kooperieren wie erforderlich (z. B. Feedback, Materialien, Zugang), damit die Leistung erbracht werden kann?",
}

# Update en.json
with open(os.path.join(lang_dir, 'en.json'), 'r', encoding='utf-8') as f:
    en_data = json.load(f)
en_data.update(new_en)
with open(os.path.join(lang_dir, 'en.json'), 'w', encoding='utf-8') as f:
    json.dump(en_data, f, ensure_ascii=False, indent=4)
print("Updated en.json")

# Update de.json
with open(os.path.join(lang_dir, 'de.json'), 'r', encoding='utf-8') as f:
    de_data = json.load(f)
de_data.update(de_new)
with open(os.path.join(lang_dir, 'de.json'), 'w', encoding='utf-8') as f:
    json.dump(de_data, f, ensure_ascii=False, indent=4)
print("Updated de.json")

# Other languages: add with English fallback for now
other_langs = ['es', 'fr', 'it', 'pt', 'ru', 'zh', 'ja', 'ar']
for lang in other_langs:
    path = os.path.join(lang_dir, f'{lang}.json')
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as f:
            data = json.load(f)
        for k, v in new_en.items():
            if k not in data:
                data[k] = v
        with open(path, 'w', encoding='utf-8') as f:
            json.dump(data, f, ensure_ascii=False, indent=4)
        print(f"Updated {lang}.json")

print("Done!")
