import json
json_data = '{"name":"Bryan"}'
python_obj = json.loads(json_data)
print(python_obj["name"])
