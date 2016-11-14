require 'httparty'

@result = HTTParty.post('http://localhost/sprusage/report.php',
  :body => {
    :field1 => 'value1',
    :field2 => 'value2',
    :field3 => 'value3',
    :username => 'administrator',
    :password => 'KeepWatchingTheSkies',
  }.to_json,
  :headers => {
    'Content-Type' => 'application/json',
  }
)

puts @result.parsed_response
