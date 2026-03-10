import json, os

lang_dir = r'C:\sites\audit-tool-app\lang'

# All new strings to be translated: pillar names + question texts + descriptions
new_en_strings = {
    # ── Pillar names
    "Umsatz": "Umsatz",
    "Gewinn": "Gewinn",
    "Ordnung": "Ordnung",
    "Einfluss": "Einfluss",
    "Vermächtnis": "Vermächtnis",

    # ── Pillar descriptions
    "Revenue — The foundation of the pyramid. Evaluates how reliably and predictably the business generates income.":
        "Revenue — The foundation of the pyramid. Evaluates how reliably and predictably the business generates income.",
    "Profit — Evaluates whether the revenue translates into healthy, sustainable profit margins.":
        "Profit — Evaluates whether the revenue translates into healthy, sustainable profit margins.",
    "Order / Structure — Evaluates the internal systems, processes, and team structures that allow the business to scale.":
        "Order / Structure — Evaluates the internal systems, processes, and team structures that allow the business to scale.",
    "Influence / Market Presence — Evaluates brand authority, customer loyalty, and market position.":
        "Influence / Market Presence — Evaluates brand authority, customer loyalty, and market position.",
    "Legacy — Evaluates the long-term sustainability, cultural health, and societal impact of the business.":
        "Legacy — Evaluates the long-term sustainability, cultural health, and societal impact of the business.",

    # ── UMSATZ questions
    "How qualified and consistent is the quality of your incoming leads?":
        "How qualified and consistent is the quality of your incoming leads?",
    "Rate the reliability and quality of your lead pipeline on a scale of 1-5.":
        "Rate the reliability and quality of your lead pipeline on a scale of 1-5.",
    "What is your current sales closing rate and how consistent is it?":
        "What is your current sales closing rate and how consistent is it?",
    "Evaluate how reliably your sales process converts prospects into paying customers.":
        "Evaluate how reliably your sales process converts prospects into paying customers.",
    "How accurately can you predict your revenue for the next 3 months?":
        "How accurately can you predict your revenue for the next 3 months?",
    "Assess the reliability of your revenue forecasting model.":
        "Assess the reliability of your revenue forecasting model.",
    "Are your customers consistent, reliable, and do they renew or return?":
        "Are your customers consistent, reliable, and do they renew or return?",
    "Evaluate customer reliability, churn rate, and repeat purchase behavior.":
        "Evaluate customer reliability, churn rate, and repeat purchase behavior.",
    "Is your pricing strategy optimized for your target market and value delivered?":
        "Is your pricing strategy optimized for your target market and value delivered?",
    "Assess whether your pricing reflects the value you provide and whether it is competitive.":
        "Assess whether your pricing reflects the value you provide and whether it is competitive.",

    # ── GEWINN questions
    "How healthy are your gross and net profit margins?":
        "How healthy are your gross and net profit margins?",
    "Rate the overall profitability of your business operations.":
        "Rate the overall profitability of your business operations.",
    "How effectively do you monitor and control your operating costs?":
        "How effectively do you monitor and control your operating costs?",
    "Evaluate your cost management discipline and expense review processes.":
        "Evaluate your cost management discipline and expense review processes.",
    "Is your cash flow consistently positive and well-planned?":
        "Is your cash flow consistently positive and well-planned?",
    "Assess whether your business maintains a healthy, predictable cash position.":
        "Assess whether your business maintains a healthy, predictable cash position.",
    "What is the measurable return on investment (ROI) of your marketing spend?":
        "What is the measurable return on investment (ROI) of your marketing spend?",
    "Evaluate how well you track and optimize the returns from your marketing investments.":
        "Evaluate how well you track and optimize the returns from your marketing investments.",
    "Do you have sufficient financial reserves to cover 3+ months of operations?":
        "Do you have sufficient financial reserves to cover 3+ months of operations?",
    "Assess how prepared your business is to handle unexpected disruptions.":
        "Assess how prepared your business is to handle unexpected disruptions.",

    # ── ORDNUNG questions
    "Are your core business processes fully documented and consistently followed?":
        "Are your core business processes fully documented and consistently followed?",
    "Evaluate the maturity and adoption of your Standard Operating Procedures (SOPs).":
        "Evaluate the maturity and adoption of your Standard Operating Procedures (SOPs).",
    "How well are your repetitive and administrative tasks automated?":
        "How well are your repetitive and administrative tasks automated?",
    "Assess the level of automation across your operations, sales, and marketing workflows.":
        "Assess the level of automation across your operations, sales, and marketing workflows.",
    "Can your team operate effectively without your direct daily involvement?":
        "Can your team operate effectively without your direct daily involvement?",
    "Rate the autonomy and self-sufficiency of your team structure.":
        "Rate the autonomy and self-sufficiency of your team structure.",
    "Is your business data well-organized, accessible, and secure?":
        "Is your business data well-organized, accessible, and secure?",
    "Evaluate your data management practices, tool stack, and security hygiene.":
        "Evaluate your data management practices, tool stack, and security hygiene.",
    "How effectively does your onboarding process integrate and train new team members?":
        "How effectively does your onboarding process integrate and train new team members?",
    "Assess the quality and speed of your new hire onboarding program.":
        "Assess the quality and speed of your new hire onboarding program.",

    # ── EINFLUSS questions
    "How well-known and trusted is your brand within your target industry?":
        "How well-known and trusted is your brand within your target industry?",
    "Evaluate your brand recognition, reputation, and recall among your target audience.":
        "Evaluate your brand recognition, reputation, and recall among your target audience.",
    "What is your estimated share of your target market and is it growing?":
        "What is your estimated share of your target market and is it growing?",
    "Assess your competitive position and market penetration.":
        "Assess your competitive position and market penetration.",
    "Are you recognized as a thought leader and authority in your field?":
        "Are you recognized as a thought leader and authority in your field?",
    "Evaluate your presence as an expert voice through speaking, publishing, and media.":
        "Evaluate your presence as an expert voice through speaking, publishing, and media.",
    "How loyal are your customers and how high is your customer lifetime value?":
        "How loyal are your customers and how high is your customer lifetime value?",
    "Assess long-term customer relationships and their impact on revenue.":
        "Assess long-term customer relationships and their impact on revenue.",
    "Do you have strong strategic partnerships that actively contribute to your growth?":
        "Do you have strong strategic partnerships that actively contribute to your growth?",
    "Evaluate the quality and strategic value of your current partnerships and alliances.":
        "Evaluate the quality and strategic value of your current partnerships and alliances.",

    # ── VERMÄCHTNIS questions
    "Is your company culture positive, clearly defined, and consistently lived?":
        "Is your company culture positive, clearly defined, and consistently lived?",
    "Assess the health, alignment, and deliberateness of your organizational culture.":
        "Assess the health, alignment, and deliberateness of your organizational culture.",
    "Does your business create a measurable positive impact on your community or society?":
        "Does your business create a measurable positive impact on your community or society?",
    "Evaluate your company's social and environmental responsibility efforts.":
        "Evaluate your company's social and environmental responsibility efforts.",
    "Do you have a clear, documented vision and strategic plan for the next 10+ years?":
        "Do you have a clear, documented vision and strategic plan for the next 10+ years?",
    "Assess the clarity and ambition of your long-term company vision and strategic roadmap.":
        "Assess the clarity and ambition of your long-term company vision and strategic roadmap.",
    "Is there a documented succession plan for key leadership roles?":
        "Is there a documented succession plan for key leadership roles?",
    "Evaluate whether the business can continue and grow beyond the current leadership team.":
        "Evaluate whether the business can continue and grow beyond the current leadership team.",
    "Are your team members genuinely fulfilled, growing, and committed to the company's mission?":
        "Are your team members genuinely fulfilled, growing, and committed to the company's mission?",
    "Assess employee fulfillment, motivation, and alignment with the company's long-term purpose.":
        "Assess employee fulfillment, motivation, and alignment with the company's long-term purpose.",
}

# ── German translations (manual, accurate)
de_translations = {
    "Umsatz": "Umsatz",
    "Gewinn": "Gewinn",
    "Ordnung": "Ordnung",
    "Einfluss": "Einfluss",
    "Vermächtnis": "Vermächtnis",
    "Revenue — The foundation of the pyramid. Evaluates how reliably and predictably the business generates income.":
        "Umsatz — Das Fundament der Pyramide. Bewertet, wie zuverlässig und vorhersehbar das Unternehmen Einnahmen generiert.",
    "Profit — Evaluates whether the revenue translates into healthy, sustainable profit margins.":
        "Gewinn — Bewertet, ob der Umsatz in gesunde, nachhaltige Gewinnmargen umgewandelt wird.",
    "Order / Structure — Evaluates the internal systems, processes, and team structures that allow the business to scale.":
        "Ordnung — Bewertet interne Systeme, Prozesse und Teamstrukturen, die eine Skalierung ermöglichen.",
    "Influence / Market Presence — Evaluates brand authority, customer loyalty, and market position.":
        "Einfluss — Bewertet Markenautorität, Kundenbindung und Marktposition.",
    "Legacy — Evaluates the long-term sustainability, cultural health, and societal impact of the business.":
        "Vermächtnis — Bewertet die langfristige Nachhaltigkeit, kulturelle Gesundheit und gesellschaftliche Wirkung.",
    "How qualified and consistent is the quality of your incoming leads?": "Wie qualifiziert und konstant ist die Qualität Ihrer eingehenden Leads?",
    "Rate the reliability and quality of your lead pipeline on a scale of 1-5.": "Bewerten Sie Zuverlässigkeit und Qualität Ihrer Lead-Pipeline auf einer Skala von 1-5.",
    "What is your current sales closing rate and how consistent is it?": "Wie hoch ist Ihre aktuelle Abschlussquote und wie konsistent ist sie?",
    "Evaluate how reliably your sales process converts prospects into paying customers.": "Bewerten Sie, wie zuverlässig Ihr Verkaufsprozess Interessenten in zahlende Kunden umwandelt.",
    "How accurately can you predict your revenue for the next 3 months?": "Wie genau können Sie Ihren Umsatz für die nächsten 3 Monate vorhersagen?",
    "Assess the reliability of your revenue forecasting model.": "Beurteilen Sie die Zuverlässigkeit Ihres Umsatzprognosemodells.",
    "Are your customers consistent, reliable, and do they renew or return?": "Sind Ihre Kunden konsistent, zuverlässig und erneuern oder kehren sie zurück?",
    "Evaluate customer reliability, churn rate, and repeat purchase behavior.": "Bewerten Sie Kundenzuverlässigkeit, Abwanderungsrate und Wiederkaufverhalten.",
    "Is your pricing strategy optimized for your target market and value delivered?": "Ist Ihre Preisstrategie für Ihren Zielmarkt und den gelieferten Mehrwert optimiert?",
    "Assess whether your pricing reflects the value you provide and whether it is competitive.": "Beurteilen Sie, ob Ihre Preise den Mehrwert widerspiegeln und wettbewerbsfähig sind.",
    "How healthy are your gross and net profit margins?": "Wie gesund sind Ihre Brutto- und Nettogewinnmargen?",
    "Rate the overall profitability of your business operations.": "Bewerten Sie die Gesamtrentabilität Ihres Geschäftsbetriebs.",
    "How effectively do you monitor and control your operating costs?": "Wie effektiv überwachen und kontrollieren Sie Ihre Betriebskosten?",
    "Evaluate your cost management discipline and expense review processes.": "Bewerten Sie Ihre Kostenmanagementdisziplin und Ausgabenprüfprozesse.",
    "Is your cash flow consistently positive and well-planned?": "Ist Ihr Cashflow konstant positiv und gut geplant?",
    "Assess whether your business maintains a healthy, predictable cash position.": "Beurteilen Sie, ob Ihr Unternehmen eine gesunde, vorhersehbare Kassenlage aufrechterhält.",
    "What is the measurable return on investment (ROI) of your marketing spend?": "Wie hoch ist der messbare Return on Investment (ROI) Ihrer Marketingausgaben?",
    "Evaluate how well you track and optimize the returns from your marketing investments.": "Bewerten Sie, wie gut Sie die Erträge Ihrer Marketinginvestitionen verfolgen und optimieren.",
    "Do you have sufficient financial reserves to cover 3+ months of operations?": "Verfügen Sie über ausreichende finanzielle Rücklagen für einen Betrieb von mehr als 3 Monaten?",
    "Assess how prepared your business is to handle unexpected disruptions.": "Beurteilen Sie, wie gut Ihr Unternehmen auf unerwartete Störungen vorbereitet ist.",
    "Are your core business processes fully documented and consistently followed?": "Sind Ihre Kerngeschäftsprozesse vollständig dokumentiert und werden konsequent eingehalten?",
    "Evaluate the maturity and adoption of your Standard Operating Procedures (SOPs).": "Bewerten Sie den Reifegrad und die Einführung Ihrer Standardarbeitsanweisungen (SOPs).",
    "How well are your repetitive and administrative tasks automated?": "Wie gut sind Ihre wiederkehrenden und administrativen Aufgaben automatisiert?",
    "Assess the level of automation across your operations, sales, and marketing workflows.": "Beurteilen Sie den Automatisierungsgrad in Ihren Betriebs-, Vertriebs- und Marketingprozessen.",
    "Can your team operate effectively without your direct daily involvement?": "Kann Ihr Team effektiv ohne Ihre direkte tägliche Beteiligung arbeiten?",
    "Rate the autonomy and self-sufficiency of your team structure.": "Bewerten Sie die Autonomie und Selbstständigkeit Ihrer Teamstruktur.",
    "Is your business data well-organized, accessible, and secure?": "Sind Ihre Unternehmensdaten gut organisiert, zugänglich und sicher?",
    "Evaluate your data management practices, tool stack, and security hygiene.": "Bewerten Sie Ihre Datenverwaltungspraktiken, Ihren Tool-Stack und Ihre Sicherheitshygiene.",
    "How effectively does your onboarding process integrate and train new team members?": "Wie effektiv integriert und schult Ihr Onboarding-Prozess neue Teammitglieder?",
    "Assess the quality and speed of your new hire onboarding program.": "Beurteilen Sie die Qualität und Geschwindigkeit Ihres Einarbeitungsprogramms.",
    "How well-known and trusted is your brand within your target industry?": "Wie bekannt und vertrauenswürdig ist Ihre Marke in Ihrer Zielbranche?",
    "Evaluate your brand recognition, reputation, and recall among your target audience.": "Bewerten Sie Ihre Markenbekanntheit, Ihren Ruf und Ihre Erinnerungswirkung bei Ihrer Zielgruppe.",
    "What is your estimated share of your target market and is it growing?": "Wie hoch ist Ihr geschätzter Anteil an Ihrem Zielmarkt und wächst er?",
    "Assess your competitive position and market penetration.": "Beurteilen Sie Ihre Wettbewerbsposition und Marktdurchdringung.",
    "Are you recognized as a thought leader and authority in your field?": "Werden Sie als Vordenker und Autorität in Ihrem Bereich anerkannt?",
    "Evaluate your presence as an expert voice through speaking, publishing, and media.": "Bewerten Sie Ihre Präsenz als Expertenstimme durch Vorträge, Veröffentlichungen und Medien.",
    "How loyal are your customers and how high is your customer lifetime value?": "Wie loyal sind Ihre Kunden und wie hoch ist Ihr Kundenwert (LTV)?",
    "Assess long-term customer relationships and their impact on revenue.": "Beurteilen Sie langfristige Kundenbeziehungen und deren Auswirkungen auf den Umsatz.",
    "Do you have strong strategic partnerships that actively contribute to your growth?": "Verfügen Sie über starke strategische Partnerschaften, die aktiv zu Ihrem Wachstum beitragen?",
    "Evaluate the quality and strategic value of your current partnerships and alliances.": "Bewerten Sie Qualität und strategischen Wert Ihrer aktuellen Partnerschaften und Allianzen.",
    "Is your company culture positive, clearly defined, and consistently lived?": "Ist Ihre Unternehmenskultur positiv, klar definiert und wird sie konsequent gelebt?",
    "Assess the health, alignment, and deliberateness of your organizational culture.": "Beurteilen Sie Gesundheit, Ausrichtung und Bewusstheit Ihrer Unternehmenskultur.",
    "Does your business create a measurable positive impact on your community or society?": "Schafft Ihr Unternehmen eine messbare positive Wirkung auf Ihre Gemeinschaft oder Gesellschaft?",
    "Evaluate your company's social and environmental responsibility efforts.": "Bewerten Sie die sozialen und ökologischen Verantwortungsbemühungen Ihres Unternehmens.",
    "Do you have a clear, documented vision and strategic plan for the next 10+ years?": "Haben Sie eine klare, dokumentierte Vision und einen strategischen Plan für die nächsten 10+ Jahre?",
    "Assess the clarity and ambition of your long-term company vision and strategic roadmap.": "Beurteilen Sie Klarheit und Ambitionen Ihrer langfristigen Unternehmensvision und Strategie.",
    "Is there a documented succession plan for key leadership roles?": "Gibt es einen dokumentierten Nachfolgeplan für wichtige Führungspositionen?",
    "Evaluate whether the business can continue and grow beyond the current leadership team.": "Beurteilen Sie, ob das Unternehmen über das aktuelle Führungsteam hinaus weiterbestehen und wachsen kann.",
    "Are your team members genuinely fulfilled, growing, and committed to the company's mission?": "Sind Ihre Teammitglieder wirklich erfüllt, wachsen sie und sind sie der Mission des Unternehmens verpflichtet?",
    "Assess employee fulfillment, motivation, and alignment with the company's long-term purpose.": "Beurteilen Sie Mitarbeiterzufriedenheit, Motivation und Ausrichtung auf den Unternehmenszweck.",
}

# Load the existing English file
with open(os.path.join(lang_dir, 'en.json'), 'r', encoding='utf-8') as f:
    en_data = json.load(f)

# Add new strings to en.json
en_data.update(new_en_strings)
with open(os.path.join(lang_dir, 'en.json'), 'w', encoding='utf-8') as f:
    json.dump(en_data, f, ensure_ascii=False, indent=4)
print("Updated en.json")

# Update de.json with accurate German translations
with open(os.path.join(lang_dir, 'de.json'), 'r', encoding='utf-8') as f:
    de_data = json.load(f)
de_data.update(de_translations)
with open(os.path.join(lang_dir, 'de.json'), 'w', encoding='utf-8') as f:
    json.dump(de_data, f, ensure_ascii=False, indent=4)
print("Updated de.json")

# For all other languages, add English as fallback (won't show [XX] prefix)
other_langs = ['es', 'fr', 'it', 'pt', 'ru', 'zh', 'ja', 'ar']
for lang in other_langs:
    lang_file = os.path.join(lang_dir, f'{lang}.json')
    if os.path.exists(lang_file):
        with open(lang_file, 'r', encoding='utf-8') as f:
            data = json.load(f)
        # Add new keys with English fallback (clean, no [XX] prefix)
        for k, v in new_en_strings.items():
            if k not in data:
                data[k] = v 
        with open(lang_file, 'w', encoding='utf-8') as f:
            json.dump(data, f, ensure_ascii=False, indent=4)
        print(f"Updated {lang}.json")

print("Done! All language files updated.")
