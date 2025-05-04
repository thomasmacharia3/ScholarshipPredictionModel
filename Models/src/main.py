from flask import Flask, request, jsonify
from flask_cors import CORS  # Import CORS
import numpy as np
import tensorflow as tf  # Assuming you're using TensorFlow for the model

# Initialize Flask app
app = Flask(__name__)

# Enable CORS for all routes
CORS(app)  # You can also specify origins or other options here

# Load your model (assuming it's a pre-trained model saved as 'model.h5')
model = tf.keras.models.load_model('scholarship_model.h5')

# Function to make predictions for a single custom example
def get_single_prediction(model, data):
    # Reshape data to match the model input shape (e.g., adding an extra dimension if needed)
    data_reshaped = np.expand_dims(data, axis=-1) if len(data.shape) == 2 else data
    prediction = model.predict(data_reshaped)
    return prediction

# Mapping for encoding the input
education_map = {'Undergraduate': 0, 'Postgraduate': 1, 'Doctrate': 2}
percentage_map = {'60-70': 0, '70-80': 1, '80-90': 2, '90-100': 3}
income_map = {'Upto 1.5L': 0, '1.5L to 3L': 1, '3L to 6L': 2, 'Above 6L': 3}
gender_map = {'Male': 1, 'Female': 0}
disability_map = {'Yes': 1, 'No': 0}
sports_map = {'Yes': 1, 'No': 0}

# API endpoint for prediction
@app.route('/predict', methods=['POST'])
def predict():
    # Get input data from the POST request (assumed to be in JSON format)
    data = request.get_json()

    # Map the input to the encoded format
    custom_example_encoded = np.array([
        education_map[data['Education_Qualification']],
        percentage_map[data['Annual-Percentage']],
        income_map[data['Income']],
        gender_map[data['Gender']],
        disability_map[data['Disability']],
        sports_map[data['Sports']]
    ]).reshape(1, -1)  # Reshape to a 2D array (1 sample, 6 features)

    # Get model predictions (raw sigmoid output)
    predictions_raw = get_single_prediction(model, custom_example_encoded)
    print(predictions_raw[0][0])

    # Apply threshold to get predicted class (0 or 1)
    predicted_class = 1 if predictions_raw[0][0] > 0.5 else 0

    # Convert all values to native Python types (e.g., float instead of float32)
    predictions_raw_float = float(predictions_raw[0][0])

    # Return the result as JSON
    return jsonify({
        'input': data,
        'raw_prediction': predictions_raw_float,
        'predicted_class': predicted_class
    })

# Run the Flask app
if __name__ == '__main__':
    app.run(debug=True)
