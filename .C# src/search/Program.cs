using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;


namespace Test
{
    class Program
    {
        static void Main(string[] args)
        {
            //Finds the search results and then downloads them.
            WebClient webClient = new WebClient();
            String url = "https://api.quizlet.com/2.0/search/sets?client_id=RFsBbdeZFt&whitespace=1&q=" + args[0];
            dynamic result = JObject.Parse(webClient.DownloadString(url));

            //Writes search results to the console.
            Console.WriteLine(result);
            int numresults = result.sets[0].term_count;
            Console.WriteLine(numresults.ToString());

            //Saves search results as a .json file.
            string json = JsonConvert.SerializeObject(result);
            String filename = @"C:\Users\ryan\desktop\results\" + args[0] + ".json";
            System.IO.File.WriteAllText(filename, json);
        }
    }
}
