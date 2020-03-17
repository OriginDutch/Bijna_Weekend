from flask import Flask, render_template      

app = Flask(__name__)

@app.route("/")
def home():
    return render_template("home.php")
    
@app.route("/about")
def about():
    return render_template("about.php")
    
if __name__ == "__main__":
    app.run(debug=True)