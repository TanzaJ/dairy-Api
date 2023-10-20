from bs4 import BeautifulSoup
import requests
import re
import csv
import json


URL = "https://www.cheese.com/"

response = requests.get(URL)
html_content = response.text
soup = BeautifulSoup(html_content, 'html.parser')
cheese_items = soup.find_all(class_="col-sm-6 col-md-4 col-lg-3 cheese-item text-center")
page = 1
cheese_dict = dict()
cheese_data_list = []


for i in range(1, 20):
    URL = "https://www.cheese.com/?per_page=100&page={}".format(i)
    response = requests.get(URL)
    html_content = response.text
    soup = BeautifulSoup(html_content, 'html.parser')

    cheese_items = soup.find_all(class_="cheese-image")
    for item in cheese_items:
        a_element = item.find("a")

        if a_element:
            cheese_name = a_element.get('href')
            URL = "https://www.cheese.com{}".format(cheese_name)

            response = requests.get(URL)
            html_content = response.text
            soup = BeautifulSoup(html_content, 'html.parser')
            cheese_points = soup.find(class_="summary-points")
            cheese_info = cheese_points.find_all("p")
            cheese_info_dict = {}

            for info in cheese_info:
                cheese_info_text = info.text
                parts = cheese_info_text.split(':')

                if len(parts) == 1:
                    feature = "Milk Type"
                    data = parts[0].strip().lstrip().lstrip('\t')
                elif len(parts) == 2:
                    feature = parts[0].strip().lstrip().lstrip('\t')
                    data = " ".join(re.split("\s+", parts[1].strip(), flags=re.UNICODE))

                if feature == 'Country of origin':

                    cheese_info_dict[feature] = data

                cheese_dict[cheese_name] = cheese_info_dict
                cheese_data_list.append([cheese_name] + list(cheese_info_dict.values()))

            print(cheese_dict)

            print('----------------')

# Define the JSON file name
json_file_name = 'cheese_data.json'

# Save the data to the JSON file
with open(json_file_name, 'w') as json_file:
    json.dump(cheese_dict, json_file, indent=4)

print(f'Data saved to {json_file_name}')

# Define the CSV file name
csv_file_name = 'cheese_data.csv'

# Write the data to the CSV file
with open(csv_file_name, 'w', newline='') as csv_file:
    writer = csv.writer(csv_file)

    # Write the header row
    header = ['Cheese Name', 'Milk Type', 'Texture', 'Rind', 'Color', 'Flavor', 'Aroma']
    writer.writerow(header)

    # Write the data rows
    for cheese_data in cheese_data_list:
        writer.writerow(cheese_data)

print(f'Data saved to {csv_file_name}')
