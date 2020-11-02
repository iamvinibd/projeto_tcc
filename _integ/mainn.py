from selenium import webdriver
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium import webdriver
from selenium.webdriver.remote.webdriver import WebDriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.options import Options
import time,winsound

def start():
    global driver
    options = Options()
    options.add_experimental_option('prefs', {
        'credentials_enable_service': False,
        'profile': {
            'password_manager_enabled': False
            }
            })
    options.add_argument('--incognito')
    options.add_argument('start-fullscreen')
    options.add_experimental_option("useAutomationExtension", False)
    options.add_experimental_option("excludeSwitches", ["enable-automation"])
    driver = webdriver.Chrome(chrome_options=options, executable_path=r'C:\xampp\htdocs\projeto_tcc\_integ\chromedriver.exe')
    driver.get("http://localhost/projeto_tcc/")
    #driver.maximize_window()

    url = driver.command_executor._url
    session_id = driver.session_id
    return url,session_id


def status_record(color,state,aguarde,executor_url, session_id):
    original_execute = WebDriver.execute
    def new_command_execute(self, command, params=None):
        if command == "newSession":
            # Mock the response
            return {'success': 0, 'value': None, 'sessionId': session_id}
        else:
            return original_execute(self, command, params)
    # Patch the function before creating the driver object
    WebDriver.execute = new_command_execute
    driver = webdriver.Remote(command_executor=executor_url, desired_capabilities={})
    driver.session_id = session_id
    # Replace the patched function with original function
    WebDriver.execute = original_execute
    #state = 'testando'
    x = int(state)
    value = "document.getElementById('status').value = '{}';".format(x)
    driver.execute_script(str(value))
    cor = "document.getElementById('status').style.color = '{}';".format(color)
    driver.execute_script(str(cor))
    if aguarde == 0:
        string = "document.getElementById('statusValor').innerHTML ='{}';".format(state)
        driver.execute_script(str(string))
    else:
        string = "document.getElementById('statusValor').innerHTML ='{}';".format('Aguardando Produto...')
        driver.execute_script(str(string))
    """
    string = "document.getElementById('status').innerHTML ={};".format(state)
    print(string)
    driver.execute_script(str(string))
    #if state == 'stop':
        #driver.execute_script("document.getElementById('status').style.color = 'red';")"""



def buy(codigo,executor_url, session_id):
    original_execute = WebDriver.execute
    def new_command_execute(self, command, params=None):
        if command == "newSession":
            # Mock the response
            return {'success': 0, 'value': None, 'sessionId': session_id}
        else:
            return original_execute(self, command, params)
    # Patch the function before creating the driver object
    WebDriver.execute = new_command_execute
    driver = webdriver.Remote(command_executor=executor_url, desired_capabilities={})
    driver.session_id = session_id
    # Replace the patched function with original function
    WebDriver.execute = original_execute
    try:
        element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, '//*[@id="BuscaTable"]/tbody/tr/td[1]/input')))
    except:
        print("Elemento não encontrado")
    finally:
        search_field = driver.find_element_by_xpath('//*[@id="BuscaTable"]/tbody/tr/td[1]/input')
        search_field.send_keys(codigo + Keys.RETURN)
    return driver


ipcart = start()
time.sleep(30)
print("Testing time done")
#buy("0",ipcart[0],ipcart[1])
x = 5
y = "red"
status_record(y,x,ipcart[0],ipcart[1])
#time.sleep(10)
