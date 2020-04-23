# this is for python version 3.x
# for the first 5 imports make sure you've installed cmake, face_recognition, numpy, dlib, and opencv-python with 'pip install'
# for the mysql connector import, use 'pip install mysql-connector-python'
# use ctrl+f and search for 'notice', in the notice comments is explained what parts of the code you should change
# when uploading a student picture, make sure the file is called their name (John.jpg) the SQL queries use the file name to update the user's status

import glob
import cv2
import face_recognition
import numpy as np
import os

import mysql.connector


# 1. ESTABLISHING DATABASE CONNECTION

db = mysql.connector.connect(host='remotemysql.com', database='Fexz7WTpQa', user='Fexz7WTpQa', password='IREHEvij1U')
cursor = db.cursor()

if db.is_connected():
    print("Connected to db!")


# 2. TAKING A PICTURE

# initialize camera
cam = cv2.VideoCapture(0)

# initialize camera window
cv2.namedWindow("window")

while True:
    ret, frame = cam.read()
    cv2.imshow("window", frame) # showing the window from line 31 and the camread from line 34
    if not ret: # if nothing is read, shut off app?
        break
    k = cv2.waitKey(1)

    if k%256 == 27:
        # ESC pressed closes the app
        print("Escape hit, closing...")
        break
    elif k%256 == 32:
        # SPACE pressed saves the current snap
        img_name = "face_temp.png"
        cv2.imwrite(img_name, frame) # writes the frame to file named in previous line
        print("{} written!".format(img_name))
        break

cam.release()
cv2.destroyAllWindows()


# 3. FACIAL RECOGNITION

# Initialize arrays that will store info of people in the photos folder
known_encodings = []
known_names = []
photos_path = 'D:/xampp/htdocs/photos/' # NOTICE: CHANGE THIS TO YOUR PATH. CREATE PHOTOS FOLDER IN HTDOCS AND SAVE PICTURES OF REGISTERED STUDENTS IN THERE.

# Make an array of all the saved jpg files' paths
list_of_files = [f for f in glob.glob(photos_path+'*.jpg')]
# Find number of known faces
number_files = len(list_of_files)

names = list_of_files.copy()

# This for loop loads all the images in photos folder and retrieves their face_encodings
for i in range(number_files):
    globals()['image_{}'.format(i)] = face_recognition.load_image_file(list_of_files[i])
    globals()['image_encoding_{}'.format(i)] = face_recognition.face_encodings(globals()['image_{}'.format(i)])[0]
    known_encodings.append(globals()['image_encoding_{}'.format(i)])

    # Create array of known names and remove the path from the string
    names[i] = names[i].replace("D:/xampp/htdocs/photos\\", "") # NOTICE: CHANGE THIS TO YOUR PATH / using the photos_path var here won't work for some reason
    known_names.append(names[i]) 


# Initialize some variables
unknown_face_encodings = []
face_names = []

# Find all the faces and face encodings in the taken picture
#unknown_face_locations = face_recognition.face_locations("face_temp.png")
unknown_image = face_recognition.load_image_file("face_temp.png")
unknown_face_encodings = face_recognition.face_encodings(unknown_image)

for face_encoding in unknown_face_encodings:
    # See if the face is a match for the known face(s)
    matches = face_recognition.compare_faces(known_encodings, face_encoding)
    name = "Unknown"

    # Use the known face with the smallest distance to the new face
    face_distances = face_recognition.face_distance(known_encodings, face_encoding)
    best_match_index = np.argmin(face_distances)
    if matches[best_match_index]:
        name = known_names[best_match_index]

    face_names.append(name)

# Printing the name of the captured person, shortening the string by removing the path and the extension
name = name.replace("D:/xampp/htdocs/photos\\", "") # NOTICE: CHANGE THIS TO YOUR PATH / using the photos_path var here won't work for some reason
name = name.replace(".jpg", "")
print("It's a picture of", name, "!")


# 4. UPDATING STUDENT STATUS / instead of name, should actually use studentnumber

# Creating sql query and then replacing TEMP with the found face name
selectQuery = "SELECT loggedIn FROM users WHERE firstName = 'TEMP'"
selectQuery = selectQuery.replace("TEMP", name)
#print(selectQuery)
cursor.execute(selectQuery)
loggedIn = cursor.fetchall() [0]

if loggedIn[0] == 0:
    updateQuery = "UPDATE users SET loggedIn = 1 WHERE firstName = 'TEMP'"
    updateQuery = updateQuery.replace("TEMP", name)
    print(updateQuery)
else:
    updateQuery = "UPDATE users SET loggedIn = 0 WHERE firstName = 'TEMP'"
    updateQuery = updateQuery.replace("TEMP", name)
    print(updateQuery)

cursor.execute(updateQuery)
db.commit()

cursor.close()
db.close()

# After the face has been recognized and the students status has changed, remove the taken picture
os.remove("face_temp.png")
print("File Removed!")