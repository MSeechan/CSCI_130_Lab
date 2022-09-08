#include <iostream>
#include <fstream>

using namespace std;

void makeHTML(double matrix[][3]){
    ofstream outfile;
    outfile.open("newfile.html");
    outfile << "<!DOCTYPE html>"<<endl;
    outfile << "<html lang=\"eng\">" << endl;
    outfile << "\t<head></head>" << endl;
    outfile << "\t<body>" << endl;

    // Table
    outfile << "\t\t<table>" << endl;
    // Thead
    outfile << "\t\t\t<thead>" << endl;
    outfile << "\t\t\t\t<tr>" << endl;
    outfile << "\t\t\t\t\t<th colspan=\"3\"> Table Header</th>" << endl;
    outfile << "\t\t\t\t<tr>" << endl;
    outfile << "\t\t\t</thead>" << endl;
    // Tbody loops through the matrix for the table values
    outfile << "\t\t\t<tbody>" << endl;
    outfile << "\t\t\t\t<tr>" << endl;
    // col 1
    for (int i = 0; i < 1; i++) {
        for (int j = 0; j < 3; j++) {
            outfile << "\t\t\t\t\t<td>";
            outfile << matrix[i][j];
            outfile << "</td>" << endl;
        }
    }
    outfile << "\t\t\t\t</tr>" << endl;
    outfile << "\t\t\t\t<tr>" << endl;
    //col 2
    for (int i = 1; i < 2; i++) {
        for (int j = 0; j < 3; j++) {
            outfile << "\t\t\t\t\t<td>";
            outfile << matrix[i][j];
            outfile << "</td>" << endl;
        }
    }
    outfile << "\t\t\t\t</tr>" << endl;
    outfile << "\t\t\t</tbody>" << endl;
    //Tfooter
    outfile << "\t\t\t<tfoot>" << endl;
    outfile << "\t\t\t\t<tr>" << endl;
    // Averages
    outfile << "\t\t\t\t\t<td>2.5</td>" << endl;
    outfile << "\t\t\t\t\t<td>3.5</td>" << endl;
    outfile << "\t\t\t\t\t<td>4.5</td>" << endl;
    outfile << "\t\t\t\t</tr>" << endl;
    outfile << "\t\t\t</tfoot>" << endl;
    outfile << "\t\t</table>" << endl;
    //end of table
    outfile << "\t</body>" << endl;
    outfile << "</html>" << endl;

    //close and generate file
    outfile.close();
   
}

int main() {
    double matrix[2][3] = {{1, 2, 3}, { 4, 5, 6 }};

    makeHTML(matrix);

    return 0;
}
