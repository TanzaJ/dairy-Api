from bs4 import BeautifulSoup
import requests

URL = "https://www.cheese.com/"


#soup = BeautifulSoup(html_content, 'html.parser')
response = requests.get(URL)
html_content = response.text
soup = BeautifulSoup(html_content, 'html.parser')
cheese_items = soup.find_all(class_="col-sm-6 col-md-4 col-lg-3 cheese-item text-center")
page = 1
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
            URL =  "https://www.cheese.com{}".format(cheese_name)
       #     URL =  "https://www.cheese.com/brie/"
            response = requests.get(URL)
            html_content = response.text
            soup = BeautifulSoup(html_content, 'html.parser')
            cheese_points = soup.find(class_="summary-points")
            cheese_info = cheese_points.find_all("p")
            for info in cheese_info:
                cheese_info_text = info.text
                print(cheese_info_text)

            print('----------------')





       #     print(cheese_name)






'''
response = requests.get(URL)
html_content = response.text

soup = BeautifulSoup(html_content, 'html.parser')

links = soup.find_all('a')
for link in links:
    print(link.get('href'))  # Print the href attribute of each link


#print(response.text)
'''