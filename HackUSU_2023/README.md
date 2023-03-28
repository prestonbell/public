# Flight Delay Predictor

This project was written by Tyler Conley and Preston Bell at HackUSU 2023. *It was designed and built from start to finish in under 20 hours.

The user inputs a flight number into the app. The program uses this number to retrieve flight information from a web API. Location information from the retrieval is used to make a second API retrieval from a live weather API. The collected data is put through a logistic regression model (probabality based prediction model) and information is returned to the user. 

What information can be provided from the app? The app can inform a user with slightly over 80% accuracy that their flight will be 15+ minutes delayed or expected to be on-time.

The application uses a simple Flask web application for a user to interface with it.

The training data needs to be downloaded from [this url](https://www.kaggle.com/datasets/threnjen/2019-airline-delays-and-cancellations?resource=download&select=full_data_flightdelay.csv)
It needs to be saved into `./content/` in order to train the model up properly
