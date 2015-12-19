import urllib
import urllib.request


url = "http://172.18.1.4:8080/index.php/refresh/hour";
page = urllib.request.urlopen(url);
html = page.read();
print(html);
