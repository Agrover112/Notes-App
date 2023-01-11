import unittest
import requests
import mysql.connector

class NotesTest(unittest.TestCase):

    def setUp(self):
        self.new_url = 'http://localhost:8000/new.php'
        self.edit_url = 'http://localhost:8000/edit.php'

        self.conn= mysql.connector.connect(user="root", password="" ,host="localhost",database="NOTES")
        self.cursor=self.conn.cursor(buffered=True)

        self.note_data = {
            'title': 'Test Note',
            'content': 'This is a test note',
            'important': 1
        }
        self.note_duplicate = {
            'title': 'Grocery',
            'content': 'This is a test note',
            'important': 1
        }

    def test_note_insertion(self):

        response = requests.post(self.new_url, data=self.note_data)
        # Check that the request is successful
        self.assertEqual(response.status_code, 200)
        query='SELECT content,important FROM notes WHERE title=%s'
        title=self.note_data['title']

        self.cursor.execute(query,(title,))
        result = self.cursor.fetchone()

        self.assertEqual(result[0], self.note_data['content'])
        self.assertEqual(result[1], self.note_data['important'])


        query="DELETE FROM notes WHERE title=%s"
        title=self.note_data['title']
        self.cursor.execute(query,(title,))
        self.conn.commit()
        self.cursor.close()
        self.conn.close()

    def test_note_edit(self):
        query='INSERT INTO notes (title,content,important) VALUES (%s,%s,%s)'
        title=self.note_data['title']
        content=self.note_data['content']
        important=self.note_data['important']
        self.cursor.execute(query,(title,content,important))
        self.conn.commit()

        self.note_data['content'] = 'This is a test note edited'
        self.note_data['important'] = 0
        response = requests.post(self.edit_url, data=self.note_data)

        # Check that the request is successful
        self.assertEqual(response.status_code, 200)

        query='SELECT content,important FROM notes WHERE title=%s'
        title=self.note_data['title']

        self.cursor.execute(query,(title,))
        result = self.cursor.fetchone()

        self.assertNotEqual(result[0], self.note_data['content'])
        self.assertNotEqual(result[1], self.note_data['important'])

        query="DELETE FROM notes WHERE title=%s"
        title=self.note_data['title']
        self.cursor.execute(query,(title,))
        self.conn.commit()
        self.cursor.close()
        self.conn.close()

    def test_note_duplicacy(self):
        response = requests.post(self.new_url, data=self.note_duplicate)
        # Check that the request is successful
        self.assertEqual(response.status_code, 200)

        query='SELECT content,important FROM notes WHERE title=%s'
        title=self.note_duplicate['title']

        self.cursor.execute(query,(title,))
        result = self.cursor.fetchone()

        self.assertNotEqual(result[0], self.note_duplicate['content'])



        









if __name__ == '__main__':
    unittest.main()
