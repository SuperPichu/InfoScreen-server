import iCalToXML

import xml.etree.ElementTree as ET
tree = ET.parse('modules/calendar/calendars.xml')
root = tree.getroot()

output = []

for urlChild in root:
    file = iCalToXML.loadFileFromLink(urlChild.text)
    events = iCalToXML.getAllEvents(file)
    for event in events:
        event.owner = urlChild.get('owner')
        event.color = urlChild.get('color')
    output.extend(events)

for event in output:
    line = "<event>"
    line += str(event)
    line += "<owner>"
    line += event.owner
    line += "</owner><color>"
    line += event.color
    line += "</color></event>"
    print line
