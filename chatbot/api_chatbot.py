import pandas as pd
from flask import Flask, request, jsonify
import google.generativeai as genai
from flask_cors import CORS
import pymysql
app = Flask(__name__)
CORS(app)

genai.configure(api_key="AIzaSyAyWKSFY70ojcUxQWfk4rdyU70w76f5hmI")

generation_config = {
    "temperature": 1,
    "top_p": 0.95,
    "top_k": 40,
    "max_output_tokens": 2048,
    "response_mime_type": "text/plain",
}
# gemini-2.0-flash-exp
# gemini-1.5-flash
model = genai.GenerativeModel(
    model_name="gemini-1.5-flash",
    generation_config=generation_config,
)

# Hàm kết nối cơ sở dữ liệu
def create_connection():
    return pymysql.connect(
        host="3.84.81.160",
        port=3306,
        user="root",
        password="root",
        database="transactions_db"
    )

# Hàm lấy dữ liệu từ bảng transactions
def fetch_transactions():
    query = """
    SELECT 
        date AS Date,
        type AS Type,
        amount AS Amount,
        category AS Category,
        description AS Description
    FROM transactions;
    """
    connection = create_connection()
    try:
        # Thực thi truy vấn và đọc dữ liệu
        data = pd.read_sql(query, connection)
        return data
    except Exception as e:
        print("An error occurred:", e)
        return None
    finally:
        connection.close()

# Lấy dữ liệu từ bảng và xử lý
transactions_data = fetch_transactions()

if transactions_data is not None:
    print(transactions_data.head())  # In ra 5 dòng đầu tiên để kiểm tra
    history_data_dict = transactions_data.to_dict(orient='records')  # Chuyển đổi thành danh sách dictionary

    # Tạo danh sách history
    history_parts = []
    for row in history_data_dict:
        history_parts.append(
            f"Date: {row['Date']}, Type: {row['Type']}, Amount: {row['Amount']}, "
            f"Category: {row['Category']}, Description: {row['Description']}"
        )

history = [
    {
        "role": "user",
        "parts": history_parts,  
    }
]


@app.route('/chat', methods=['POST'])
def chat():
    user_message = request.json.get("message")
    
    history.append({
        "role": "user",
        "parts": [user_message]
    })
    
    chat_session = model.start_chat(history=history)
    
    response = chat_session.send_message(user_message)
    
    history.append({
        "role": "model",
        "parts": [response.text]
    })
    
    return jsonify({"response": response.text, "history": history})

if __name__ == '__main__':
    app.run(debug=True)
