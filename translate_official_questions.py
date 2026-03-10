import json, os

lang_dir = r'C:\sites\audit-tool-app\lang'

# All 25 official questions from the image (EN)
official_questions_en = {
    # REVENUE / UMSATZ
    "The required monthly revenue is defined and realistically planned.": "The required monthly revenue is defined and realistically planned.",
    "Suitable prospects are reached continuously.": "Suitable prospects are reached continuously.",
    "A sufficient share of leads is converted into customers.": "A sufficient share of leads is converted into customers.",
    "Services/deliveries are provided as promised.": "Services/deliveries are provided as promised.",
    "Customers meet payment and cooperation obligations.": "Customers meet payment and cooperation obligations.",
    
    # PROFIT / GEWINN
    "Existing liabilities are systematically reduced; no risky new debt.": "Existing liabilities are systematically reduced; no risky new debt.",
    "Contribution margins are healthy and actively improved.": "Contribution margins are healthy and actively improved.",
    "Customers make repeat purchases regularly.": "Customers make repeat purchases regularly.",
    "Investments are made selectively for predictable returns.": "Investments are made selectively for predictable returns.",
    "Liquidity reserves cover several months of costs.": "Liquidity reserves cover several months of costs.",
    
    # ORDER / ORDNUNG
    "Bottlenecks and waste are continuously identified and reduced.": "Bottlenecks and waste are continuously identified and reduced.",
    "Tasks are assigned according to strengths and competencies.": "Tasks are assigned according to strengths and competencies.",
    "The directly affected people can solve problems independently.": "The directly affected people can solve problems independently.",
    "Processes function even when key individuals are absent.": "Processes function even when key individuals are absent.",
    "The company consistently delivers high quality and builds reputation.": "The company consistently delivers high quality and builds reputation.",
    
    # IMPACT / EINFLUSS
    "Customers achieve noticeble improvements beyond the transaction.": "Customers achieve noticeble improvements beyond the transaction.",
    "Employees are motivated by purpose and mission.": "Employees are motivated by purpose and mission.",
    "Employees' personal goals align with the company vision.": "Employees' personal goals align with the company vision.",
    "Critical and positive feedback is actively sought and used.": "Critical and positive feedback is actively sought and used.",
    "Cooperations (including with competitors) improve the customer experience.": "Cooperations (including with competitors) improve the customer experience.",
    
    # LEGACY / VERMÄCHTNIS
    "Customers support the company long-term and recommend it.": "Customers support the company long-term and recommend it.",
    "Leadership transitions are planned and practiced.": "Leadership transitions are planned and practiced.",
    "People engage out of conviction — internally and externally.": "People engage out of conviction — internally and externally.",
    "Regular alignment with a long-term vision.": "Regular alignment with a long-term vision.",
    "The organization continuously learns and improves systemically.": "The organization continuously learns and improves systemically."
}

# German translations for all 25
official_questions_de = {
    # REVENUE / UMSATZ
    "The required monthly revenue is defined and realistically planned.": "Der erforderliche monatliche Umsatz ist definiert und realistisch geplant.",
    "Suitable prospects are reached continuously.": "Geeignete Interessenten werden kontinuierlich erreicht.",
    "A sufficient share of leads is converted into customers.": "Ein ausreichender Anteil der Leads wird in Kunden umgewandelt.",
    "Services/deliveries are provided as promised.": "Leistungen/Lieferungen werden wie versprochen erbracht.",
    "Customers meet payment and cooperation obligations.": "Kunden kommen ihren Zahlungs- und Kooperationsverpflichtungen nach.",
    
    # PROFIT / GEWINN
    "Existing liabilities are systematically reduced; no risky new debt.": "Bestehende Verbindlichkeiten werden systematisch abgebaut; keine riskanten Neuschulden.",
    "Contribution margins are healthy and actively improved.": "Die Deckungsbeiträge sind gesund und werden aktiv verbessert.",
    "Customers make repeat purchases regularly.": "Kunden tätigen regelmäßig Wiederholungskäufe.",
    "Investments are made selectively for predictable returns.": "Investitionen werden selektiv für vorhersagbare Renditen getätigt.",
    "Liquidity reserves cover several months of costs.": "Liquiditätsreserven decken die Kosten für mehrere Monate.",
    
    # ORDER / ORDNUNG
    "Bottlenecks and waste are continuously identified and reduced.": "Engpässe und Verschwendung werden kontinuierlich identifiziert und reduziert.",
    "Tasks are assigned according to strengths and competencies.": "Aufgaben werden nach Stärken und Kompetenzen zugewiesen.",
    "The directly affected people can solve problems independently.": "Die direkt betroffenen Personen können Probleme selbstständig lösen.",
    "Processes function even when key individuals are absent.": "Prozesse funktionieren auch dann, wenn Schlüsselpersonen abwesend sind.",
    "The company consistently delivers high quality and builds reputation.": "Das Unternehmen liefert konsequent hohe Qualität und baut Reputationskapital auf.",
    
    # IMPACT / EINFLUSS
    "Customers achieve noticeble improvements beyond the transaction.": "Kunden erzielen spürbare Verbesserungen, die über die Transaktion hinausgehen.",
    "Employees are motivated by purpose and mission.": "Mitarbeiter sind durch Sinn und Mission motiviert.",
    "Employees' personal goals align with the company vision.": "Die persönlichen Ziele der Mitarbeiter sind auf die Unternehmensvision ausgerichtet.",
    "Critical and positive feedback is actively sought and used.": "Kritisches und positives Feedback wird aktiv gesucht und genutzt.",
    "Cooperations (including with competitors) improve the customer experience.": "Kooperationen (auch mit Wettbewerbern) verbessern das Kundenerlebnis.",
    
    # LEGACY / VERMÄCHTNIS
    "Customers support the company long-term and recommend it.": "Kunden unterstützen das Unternehmen langfristig und empfehlen es weiter.",
    "Leadership transitions are planned and practiced.": "Führungswechsel sind geplant und werden praktiziert.",
    "People engage out of conviction — internally and externally.": "Menschen engagieren sich aus Überzeugung – intern wie extern.",
    "Regular alignment with a long-term vision.": "Regelmäßige Ausrichtung an einer langfristigen Vision.",
    "The organization continuously learns and improves systemically.": "Die Organisation lernt kontinuierlich und verbessert sich systemisch."
}

# Descriptions (EN) from seeder
descriptions_en = {
    "Revenue Requirement: Does the business have a clearly defined monthly revenue target based on actual cost structure and market reality?": "Revenue Requirement: Does the business have a clearly defined monthly revenue target based on actual cost structure and market reality?",
    "Lead Quality: Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?": "Lead Quality: Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?",
    "Closing Rate: Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?": "Closing Rate: Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?",
    "Delivery Reliability: Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?": "Delivery Reliability: Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?",
    "Contract Compliance: Do customers pay on time and cooperate as required so the service can be completed smoothly?": "Contract Compliance: Do customers pay on time and cooperate as required so the service can be completed smoothly?",
    "Debt Management: Is the company actively reducing debt and avoiding new liabilities that could threaten business stability?": "Debt Management: Is the company actively reducing debt and avoiding new liabilities that could threaten business stability?",
    "Margin: Are the margins on products/services high enough to cover overhead and generate real profit — and is the team actively working to improve them?": "Margin: Are the margins on products/services high enough to cover overhead and generate real profit — and is the team actively working to improve them?",
    "Repeat Purchases: Does the business have strong repeat purchase behavior, indicating genuine customer satisfaction and long-term value?": "Repeat Purchases: Does the business have strong repeat purchase behavior, indicating genuine customer satisfaction and long-term value?",
    "Investment Logic: Are business investments made based on clear ROI calculations rather than impulse or trend-following?": "Investment Logic: Are business investments made based on clear ROI calculations rather than impulse or trend-following?",
    "Reserves: Does the company maintain a financial buffer sufficient to cover multiple months of operating costs in case of revenue disruption?": "Reserves: Does the company maintain a financial buffer sufficient to cover multiple months of operating costs in case of revenue disruption?",
    "Process Efficiency: Does the team actively look for inefficiencies in workflows and take measurable action to eliminate them on an ongoing basis?": "Process Efficiency: Does the team actively look for inefficiencies in workflows and take measurable action to eliminate them on an ongoing basis?",
    "Role Fit: Are roles designed so that each person works primarily in their area of strength, leading to higher quality output and greater fulfillment?": "Role Fit: Are roles designed so that each person works primarily in their area of strength, leading to higher quality output and greater fulfillment?",
    "Outcome Ownership: Are employees empowered and capable of resolving issues within their domain without always escalating to management?": "Outcome Ownership: Are employees empowered and capable of resolving issues within their domain without always escalating to management?",
    "Substitutability: Are all critical processes documented and shared so the business does not grind to a halt when a key person is unavailable?": "Substitutability: Are all critical processes documented and shared so the business does not grind to a halt when a key person is unavailable?",
    "Professional Quality: Is quality control embedded in the delivery process so that every client experience reinforces a reputation for excellence?": "Professional Quality: Is quality control embedded in the delivery process so that every client experience reinforces a reputation for excellence?",
    "Customer Transformation: Does the company create measurable, meaningful change in its customers\' lives or businesses — not just fulfill a transaction?": "Customer Transformation: Does the company create measurable, meaningful change in its customers\' lives or businesses — not just fulfill a transaction?",
    "Mission Driver: Are team members genuinely driven by the company\'s mission — beyond just their paycheck — fueling higher performance and retention?": "Mission Driver: Are team members genuinely driven by the company\'s mission — beyond just their paycheck — fueling higher performance and retention?",
    "Goal Alignment: Are individual employees\' career and personal goals understood and deliberately aligned with the company\'s direction?": "Goal Alignment: Are individual employees\' career and personal goals understood and deliberately aligned with the company\'s direction?",
    "Feedback Culture: Does the organization have formal mechanisms to gather honest internal and external feedback, and does leadership act on it?": "Feedback Culture: Does the organization have formal mechanisms to gather honest internal and external feedback, and does leadership act on it?",
    "Partner Network: Has the company built cross-industry or even cross-competitor partnerships that create additional value for customers?": "Partner Network: Has the company built cross-industry or even cross-competitor partnerships that create additional value for customers?",
    "Customer Community: Do customers evolve into long-term advocates who actively refer others — forming a self-reinforcing community around the brand?": "Customer Community: Do customers evolve into long-term advocates who actively refer others — forming a self-reinforcing community around the brand?",
    "Succession Planning: Is there a documented, tested plan for leadership handover so the business can thrive beyond the current founders or key leaders?": "Succession Planning: Is there a documented, tested plan for leadership handover so the business can thrive beyond the current founders or key leaders?",
    "Voluntary Supporters: Does the company attract people — employees, customers, and partners — who engage genuinely out of belief in the mission, not just obligation?": "Voluntary Supporters: Does the company attract people — employees, customers, and partners — who engage genuinely out of belief in the mission, not just obligation?",
    "Quarterly Focus: Does the leadership team regularly review and align all activities and decisions with the long-term company vision on a structured quarterly basis?": "Quarterly Focus: Does the leadership team regularly review and align all activities and decisions with the long-term company vision on a structured quarterly basis?",
    "Continuous Adaptation: Is the company built to learn — with feedback loops, retrospectives, and improvement processes embedded in how it operates?": "Continuous Adaptation: Is the company built to learn — with feedback loops, retrospectives, and improvement processes embedded in how it operates?"
}

# German translations for descriptions
descriptions_de = {
    "Revenue Requirement: Does the business have a clearly defined monthly revenue target based on actual cost structure and market reality?": "Umsatzanforderung: Verfügt das Unternehmen über ein klar definiertes monatliches Umsatzziel, das auf der tatsächlichen Kostenstruktur und der Marktrealität basiert?",
    "Lead Quality: Does the company have a reliable, active system for consistently attracting qualified prospects — not just occasional campaigns?": "Lead-Qualität: Verfügt das Unternehmen über ein zuverlässiges, aktives System zur kontinuierlichen Gewinnung qualifizierter Interessenten – nicht nur für gelegentliche Kampagnen?",
    "Closing Rate: Is the conversion rate from prospect to paying customer high enough to meet the planned monthly revenue goal?": "Abschlussquote: Ist die Konversionsrate vom Interessenten zum zahlenden Kunden hoch genug, um das geplante monatliche Umsatzziel zu erreichen?",
    "Delivery Reliability: Does the company consistently deliver what was sold — on time, at the agreed quality, and without cutting corners?": "Lieferzuverlässigkeit: Liefert das Unternehmen konsequent das, was verkauft wurde – pünktlich, in der vereinbarten Qualität und ohne Abstriche?",
    "Contract Compliance: Do customers pay on time and cooperate as required so the service can be completed smoothly?": "Vertragserfüllung: Zahlen Kunden pünktlich und kooperieren sie wie erforderlich, damit die Leistung reibungslos erbracht werden kann?",
    "Debt Management: Is the company actively reducing debt and avoiding new liabilities that could threaten business stability?": "Schuldenmanagement: Baut das Unternehmen aktiv Schulden ab und vermeidet es neue Verbindlichkeiten, die die Stabilität gefährden könnten?",
    "Margin: Are the margins on products/services high enough to cover overhead and generate real profit — and is the team actively working to improve them?": "Marge: Sind die Margen bei Produkten/Dienstleistungen hoch genug, um die Gemeinkosten zu decken und echten Gewinn zu erzielen – und verbessert das Team diese aktiv?",
    "Repeat Purchases: Does the business have strong repeat purchase behavior, indicating genuine customer satisfaction and long-term value?": "Wiederkaufverhalten: Verfügt das Unternehmen über ein starkes Wiederkaufverhalten, das auf echte Kundenzufriedenheit und langfristigen Wert hindeutet?",
    "Investment Logic: Are business investments made based on clear ROI calculations rather than impulse or trend-following?": "Investitionslogik: Werden geschäftliche Investitionen auf der Grundlage klarer ROI-Berechnungen getätigt statt aus Impuls oder Trendfolgen?",
    "Reserves: Does the company maintain a financial buffer sufficient to cover multiple months of operating costs in case of revenue disruption?": "Reserven: Verfügt das Unternehmen über einen finanziellen Puffer, der ausreicht, um mehrere Monate Betriebskosten im Falle eines Umsatzeinbruchs zu decken?",
    "Process Efficiency: Does the team actively look for inefficiencies in workflows and take measurable action to eliminate them on an ongoing basis?": "Prozesseffizienz: Sucht das Team aktiv nach Ineffizienzen in den Arbeitsabläufen und ergreift es messbare Maßnahmen, um diese laufend zu beseitigen?",
    "Role Fit: Are roles designed so that each person works primarily in their area of strength, leading to higher quality output and greater fulfillment?": "Rollenpassung: Sind die Rollen so gestaltet, dass jede Person primär in ihrem Stärkebereich arbeitet, was zu höherer Qualität und größerer Erfüllung führt?",
    "Outcome Ownership: Are employees empowered and capable of resolving issues within their domain without always escalating to management?": "Ergebnisverantwortung: Sind die Mitarbeiter befähigt und in der Lage, Probleme in ihrem Bereich selbstständig zu lösen, ohne immer das Management einzuschalten?",
    "Substitutability: Are all critical processes documented and shared so the business does not grind to a halt when a key person is unavailable?": "Vertretbarkeit: Sind alle kritischen Prozesse dokumentiert und geteilt, damit das Geschäft nicht zum Stillstand kommt, wenn eine Schlüsselperson ausfällt?",
    "Professional Quality: Is quality control embedded in the delivery process so that every client experience reinforces a reputation for excellence?": "Professionelle Qualität: Ist die Qualitätskontrolle im Lieferprozess so verankert, dass jede Kundenerfahrung den Ruf für Exzellenz stärkt?",
    "Customer Transformation: Does the company create measurable, meaningful change in its customers\' lives or businesses — not just fulfill a transaction?": "Kundentransformation: Bewirkt das Unternehmen messbare, bedeutungsvolle Veränderungen im Leben oder Geschäft seiner Kunden – statt nur eine Transaktion zu erfüllen?",
    "Mission Driver: Are team members genuinely driven by the company\'s mission — beyond just their paycheck — fueling higher performance and retention?": "Missionsantrieb: Werden die Teammitglieder wirklich von der Mission des Unternehmens angetrieben – über den Gehaltsscheck hinaus – was Leistung und Bindung stärkt?",
    "Goal Alignment: Are individual employees\' career and personal goals understood and deliberately aligned with the company\'s direction?": "Zielausrichtung: Werden die Karriere- und persönlichen Ziele der einzelnen Mitarbeiter verstanden und bewusst auf die Richtung des Unternehmens ausgerichtet?",
    "Feedback Culture: Does the organization have formal mechanisms to gather honest internal and external feedback, and does leadership act on it?": "Feedbackkultur: Verfügt die Organisation über formale Mechanismen, um ehrliches internes und externes Feedback einzuholen, und handelt die Führung danach?",
    "Partner Network: Has the company built cross-industry or even cross-competitor partnerships that create additional value for customers?": "Partnernetzwerk: Hat das Unternehmen branchenübergreifende oder sogar wettbewerbsübergreifende Partnerschaften aufgebaut, die zusätzlichen Wert für Kunden schaffen?",
    "Customer Community: Do customers evolve into long-term advocates who actively refer others — forming a self-reinforcing community around the brand?": "Kunden-Community: Entwickeln sich Kunden zu langfristigen Befürwortern, die andere aktiv werben – und so eine selbstverstärkende Marken-Community bilden?",
    "Succession Planning: Is there a documented, tested plan for leadership handover so the business can thrive beyond the current founders or key leaders?": "Nachfolgeplanung: Gibt es einen dokumentierten, geprüften Plan für die Führungsübergabe, damit das Unternehmen über die heutigen Gründer oder Führungskräfte hinaus florieren kann?",
    "Voluntary Supporters: Does the company attract people — employees, customers, and partners — who engage genuinely out of belief in the mission, not just obligation?": "Freiwillige Unterstützer: Zieht das Unternehmen Menschen an, die sich aus Überzeugung für die Mission engagieren, nicht nur aus Verpflichtung?",
    "Quarterly Focus: Does the leadership team regularly review and align all activities and decisions with the long-term company vision on a structured quarterly basis?": "Quartalsfokus: Überprüft das Führungsteam regelmäßig alle Aktivitäten und Entscheidungen und richtet diese strukturiert auf die langfristige Unternehmensvision aus?",
    "Continuous Adaptation: Is the company built to learn — with feedback loops, retrospectives, and improvement processes embedded in how it operates?": "Kontinuierliche Anpassung: Ist das Unternehmen lernfähig aufgebaut – mit Feedbackschleifen, Retrospektiven und Verbesserungsprozessen in allen Abläufen?"
}

# Add pillar names if missing
other_strings = {
    "Pillar": "Pillar",
    "Umsatz": "Umsatz",
    "Gewinn": "Gewinn",
    "Ordnung": "Ordnung",
    "Einfluss": "Einfluss",
    "Vermächtnis": "Vermächtnis"
}

# Update all lang files
all_en = {**official_questions_en, **descriptions_en, **other_strings}
all_de = {**official_questions_de, **descriptions_de, **other_strings}

with open(os.path.join(lang_dir, 'en.json'), 'r', encoding='utf-8') as f:
    data = json.load(f)
data.update(all_en)
with open(os.path.join(lang_dir, 'en.json'), 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=4)

with open(os.path.join(lang_dir, 'de.json'), 'r', encoding='utf-8') as f:
    data = json.load(f)
data.update(all_de)
with open(os.path.join(lang_dir, 'de.json'), 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=4)

other_langs = ['es', 'fr', 'it', 'pt', 'ru', 'zh', 'ja', 'ar']
for lang in other_langs:
    path = os.path.join(lang_dir, f'{lang}.json')
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as f:
            data = json.load(f)
        for k, v in all_en.items():
            if k not in data:
                data[k] = v
        with open(path, 'w', encoding='utf-8') as f:
            json.dump(data, f, ensure_ascii=False, indent=4)

print("Done updating all language files with official questions.")
