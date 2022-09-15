# Preston Bell
# DATA 5500
# Final Project

import requests
import json
import csv
import argparse
import os
import time
from datetime import datetime as dt
from time import sleep

# important data
tickers = ["AAPL", "ADBE", "CAT", "CSCO", "DIS", "HPE", "RYCEY", "TXN", "UL", "TWTR", "IBM"]
utility_list = []
results = {}  
API_KEY = "FNAZOTP0OASGY0BZ"
url1 = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol="
url2 = "&outputsize=full&apikey="
key_1 = "Time Series (Daily)"
key_2 = "4. close"
largest_profit = 0
highest_profit_ticker = ""

############ ALPACA ############ ALPACA ############ ALPACA ############ ALPACA ############ ALPACA ############ ALPACA ############

# information for submitting orders to Alpaca
api_Key = "PKXU8XXL1FGLE96QJGMJ"
secret_Key = "JmEweepQyn30LWuXj2mSiV0Qf3y2h0FXLsAE7sqf"
endpointURL = "https://paper-api.alpaca.markets"
accountURL = "{}/v2/account".format(endpointURL)
ordersURL = "{}/v2/orders".format(endpointURL)
headers1 = {'APCA-API-KEY-ID': api_Key, 'APCA-API-SECRET-KEY': secret_Key}

# opens Alpaca account
def get_account():
    r = requests.get(accountURL, headers=headers1)
    return json.loads(r.content)

# creates Alpaca order
def create_order(symbol, quantity, side, types, time):
    data = {
        "symbol": symbol,
        "qty": quantity, 
        "side": side,
        "type": types,
        "time_in_force": time
    }
    r = requests.post(ordersURL, json=data, headers=headers1)
    return json.loads(r.content)

#######################################################################################################

# saves results from analysis into a json file
def saveResults(results):
    json.dump(results, open("results.json", "w"))  
    
#######################################################################################################

# looks inside existing csv files to determine the last date for which data was collected in order to append new data
def findLastDate(ticker):
    with open("/home/ubuntu/environment/" + ticker + "File.csv", "r") as file:
        csv_reader = csv.reader(file, delimiter=',')
        line = ""
        for line in csv_reader:
            pass
        if line and len(line) == 2:
            last_date = line[1] 
        else: 
            default_date = "2022-01-28"
            last_date = default_date
        return last_date

#########################################################################################################

def meanReversionStrategy(prices):
    #threshold bands
    buy_thresh = 0.95       
    sell_thresh = 1.05    
    
    #alternates buying and selling
    buying = 1          
    #profit calculations
    last_buy_price = 0       
    last_sell_price = 0  
    profit = 0
    
    mov_avg_range = prices[-6:-1]                  
    moving_average = sum(mov_avg_range) / 5
    current_price = last_price
    
    if current_price < (moving_average * buy_thresh):
        #allows buying unless last action was a purchase
        if buying == 1:                       
            create_order(ticker,1,"buy","market","gtc")
            print("Buy today at: " + str(current_price))
            last_buy_price = current_price
        
    elif current_price > (moving_average * sell_thresh):         
        #allows selling unless last action was a sale
        if buying == 0:          
            create_order(ticker,1,"sell","market","gtc")
            print("sell today at: " + str(current_price))
            last_sell_price = current_price
            profit = last_sell_price - last_buy_price            
            print("Profit: " + str(round(profit, 2)))
            #sale made, next action must be a purchase
            buying = 1  
    else:
        print("no purchases or sales today")
            
    print("..................\n") 
    print("Mean Reversion Results")
    print("Profit for today: " + str(profit))
    print("___________________\n")
    return profit

####################################################################################################################################

def simpleMovingAverageStrategy(prices):
    #alternates buying and selling
    buying = 1          
    #profit calculations
    last_buy_price = 0       
    last_sell_price = 0  

    #range markers
    mov_avg_1 = prices[-6]            
    mov_avg_2 = prices[-2]
    profit = 0
    
    #slices the five days to be used in the range's average
    mov_avg_range = prices[-6:-1]                  
    moving_average = sum(mov_avg_range) / 5                     
    current_price = prices[-1]                        
    
    if current_price > moving_average:                           
        if buying == 1:          
            create_order(ticker,1,"buy","market","gtc")
            print("Buy today at: " + str(current_price))
            last_buy_price = current_price
            buying = 0                                          

    elif current_price < moving_average:                        
        if buying == 0:              
            create_order(ticker,1,"sell","market","gtc")
            print("Sell today at: " + str(current_price))
            last_sell_price = current_price
            profit = last_sell_price - last_buy_price            
        
            print("Profit: " + str(round(profit, 2)))
            buying = 1                                           
    else:
        print("no action today")
            
    print("..................\n") 
    print("Simple Moving Average Results")
    print("Profit for today: " + str(profit))
    print("___________________\n")
    return profit
    
####################################################################################################################################

# refer to (https://www.youtube.com/watch?v=FdU3q1wspbk) for details about this strategy
def twentyPercentFlipperStrategy(prices):
    
    #alternates buying and selling
    buying = 1  
    #looks for shorting opportunities
    look_for_short_selling = 1
    #profit calculations
    last_buy_price = 0       
    last_sell_price = 0   
    sell_short_price = 0
    buy_short_price = 0
    profit = 0
    
    #range markers
    mov_1 = prices[-51]            
    mov_2 = prices[-2]           
    
    mov_range = prices[-51:-1]                  
    #moving_average = sum(mov_avg_range) / 50                   
    fifty_day_low = min(mov_range)
    fifty_day_high = max(mov_range)
    current_price = prices[-1]                       
    
    #logic for short selling
    if current_price < (fifty_day_high * 0.80) and buying == 1 and look_for_short_selling == 1:
        create_order(ticker,1,"buy","market","gtc")
        print("Short at: " + str(current_price))
        sell_short_price = current_price
        look_for_short_selling = 0
    
    elif current_price > (fifty_day_low * 1.20) and buying == 1:  
        if look_for_short_selling == 0:
            create_order(ticker,1,"sell","market","gtc")
            print("Buying the short")
            profit += sell_short_price - buy_short_price
        else:
            print("Buy at: " + str(current_price))
            create_order(ticker,1,"buy","market","gtc")
            last_buy_price = current_price
            buying = 0                                         
            
    elif current_price < (fifty_day_high * 0.80) and buying == 0:    
        create_order(ticker,1,"sell","market","gtc")
        print("Sell at: " + str(current_price))
        last_sell_price = current_price
        profit += last_sell_price - last_buy_price            
        print("Profit: " + str(round(profit, 2)))
        buying = 1                                        
    else:
        print("no actions today")
            
    print("..................\n") 
    print("20% Flipper Results")
    print("Profit for today: " + str(profit))
    print("___________________\n")
    return profit

####################################################################################################################################

for index, ticker in enumerate(tickers):
    # allows for ticker enumeration to limit API calls
    if 0 == index % 4 and index != 0:
        print("Sleeping for 60 seconds for API")
        sleep(60)
        
    # opens csv to write
    fileName = str(ticker) + "File.csv"
    with open(fileName, "w") as f:
        pass
    last_date = "2022-01-28"
    findLastDate(ticker)
    
    # finds data online to append to csv
    full_URL = url1 + ticker + url2 + API_KEY
    req = requests.get(full_URL)
    fullDic = json.loads(req.text)
    
    last_date = time.strptime(last_date, "%Y-%m-%d")
    for date in fullDic[key_1]:
        day = time.strptime(date, "%Y-%m-%d")
        if day > last_date:
            closing_price = fullDic[key_1][date][key_2]
            utility_list.append([closing_price,str(date)])

    # reverses list of data before saving it to csv
    utility_list.reverse()
    
    # writes to csv
    if os.stat(fileName).st_size == 0:
        with open(fileName, "a") as f:
            writer = csv.DictWriter(f, fieldnames=["Closing Price", "Date"])
            writer.writeheader()
        
    with open(fileName, "a") as f:
        writer = csv.writer(f)
        writer.writerows(utility_list)
        f.close()
        
    prices = []
    #price column of csv for each ticker
    with open("/home/ubuntu/environment/" + ticker + "File.csv", "r") as file:
        csv_reader = csv.reader(file, delimiter=',')
        line = ""
        iterate = iter(csv_reader)
        next(iterate)
        for line in iterate:
            each_price = line[0]
            prices.append(float(each_price))

    #finds the last (most recent) recorded closing price
    last_price = prices[-1]
      
    #sends profit information (from mean reversion strategy) to results dictionary
    profit = meanReversionStrategy(prices)
    results[ticker + "_mr_profit"] = profit
    print("profit from " + str(ticker) + "is: " + str(profit))
    
    #sends profit information (from simple moving average strategy) to results dictionary
    profit = simpleMovingAverageStrategy(prices)
    results[ticker + "_sma_profit"] = profit
    print("profit from " + str(ticker) + "is: " + str(profit))

    #sends profit information (from 20% flipper strategy) to results dictionary
    profit = twentyPercentFlipperStrategy(prices)
    results[ticker + "_tpf_profit"] = profit
    print("profit from " + str(ticker) + " is: " + str(profit))
    
    if profit >= largest_profit:
        largest_profit = profit
        highest_profit_ticker = ticker

    # saves the dictionary 
    saveResults(results)
    
print(str(highest_profit_ticker) + " stock made the highest profit today, which was: " + str(largest_profit))